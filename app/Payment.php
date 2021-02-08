<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    public $timestamps = false;
    protected $connection = 'paymentgateway';

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

    public function getTotalFormatAttribute()
    {
        return Functions::formatCurrency($this->transactionmount);
    }
}
