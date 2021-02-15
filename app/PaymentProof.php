<?php

namespace App;

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
}
