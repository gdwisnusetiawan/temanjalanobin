<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;

class PaymentProof extends Model
{
    protected $table = 'payment_proof';
    public $timestamps = false;
    protected $connection = 'paymentgateway';

    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    public function getDateFormatAttribute()
    {
        return Functions::datetimeFormat($this->payment_date);
    }

    public function getTotalFormatAttribute()
    {
        return Functions::formatCurrency($this->transfer_amount);
    }

    public function getStatusDescAttribute()
    {
        if($this->status == 1) {
            $desc = ['text' => 'pending', 'color' => 'warning'];
        }
        elseif($this->status == 2) {
            $desc = ['text' => 'approved', 'color' => 'success'];
        }
        elseif($this->status == 3) {
            $desc = ['text' => 'rejected', 'color' => 'danger'];
        }
        else {
            $desc = ['text' => 'pending', 'color' => 'warning'];
        }
        return $desc;
    }
}
