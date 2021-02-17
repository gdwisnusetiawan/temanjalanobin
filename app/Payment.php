<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    public $timestamps = false;
    protected $connection = 'paymentgateway';

    public function getRouteKeyName()
    {
        return 'transactionno';
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function merchant()
    {
        return $this->belongsTo('App\Merchant');
    }

    public function order()
    {
        return $this->belongsTo('App\Order', 'transactionno', 'invoiceno');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function getDateFormatAttribute()
    {
        return Functions::datetimeFormat($this->transactiondate);
    }

    public function getExpireFormatAttribute()
    {
        return Functions::datetimeFormat($this->transactionexpire);
    }

    public function getTotalFormatAttribute()
    {
        return Functions::formatCurrency($this->transactionmount);
    }

    public function getStatusDescAttribute()
    {
        if($this->status == 1) {
            $desc = ['text' => 'pending', 'color' => 'info'];
        }
        elseif($this->status == 2) {
            $desc = ['text' => 'wait', 'color' => 'warning'];
        }
        elseif($this->status == 3) {
            $desc = ['text' => 'paid', 'color' => 'success'];
        }
        elseif($this->status == 4) {
            $desc = ['text' => 'cancel', 'color' => 'danger'];
        }
        elseif($this->status == 5) {
            $desc = ['text' => 'expired', 'color' => 'danger'];
        }
        else {
            $desc = ['text' => 'pending', 'color' => 'info'];
        }
        return $desc;
    }
}
