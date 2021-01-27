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

    public function getSubtotalFormatAttribute()
    {
        return Functions::formatCurrency($this->price);
    }

    public function getTotalFormatAttribute()
    {
        return Functions::formatCurrency($this->price - $this->discount);
    }
}
