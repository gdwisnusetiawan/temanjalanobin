<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    public $timestamps = false;
    protected $connection = 'production';

    public function getRouteKeyName()
    {
        return 'invoiceno';
    }

    public function suborders()
    {
        return $this->hasMany('App\Suborder', 'invoiceno', 'invoiceno');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'uid', 'id');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment', 'transactionno', 'invoiceno');
    }

    public function getGrandTotalAttribute()
    {
        return $this->price - $this->discount + $this->shipping_cost;
    }

    public function getBalanceAttribute()
    {
        return $this->grand_total - $this->payments->sum('transactionmount');
    }

    public function getShippingCostFormatAttribute()
    {
        return Functions::formatCurrency($this->shipping_cost);
    }

    public function getSubtotalFormatAttribute()
    {
        return Functions::formatCurrency($this->price);
    }

    public function getTotalFormatAttribute()
    {
        return Functions::formatCurrency($this->grand_total);
    }

    public function getOrderdateFormatAttribute()
    {
        return Functions::datetimeFormat($this->orderdate);
    }

    public function getDuedateFormatAttribute()
    {
        return Functions::datetimeFormat($this->duedate);
    }

    public function getBalanceFormatAttribute()
    {
        return Functions::formatCurrency($this->balance);
    }
}
