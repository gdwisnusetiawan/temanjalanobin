<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    public $timestamps = false;
    protected $connection = 'paymentgateway';

    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    public function order()
    {
        return $this->belongsTo('App\Order', 'transactionno', 'invoiceno');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'productid', 'id');
    }
}
