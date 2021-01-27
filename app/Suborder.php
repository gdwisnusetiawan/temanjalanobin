<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;

class Suborder extends Model
{
    protected $table = 'suborder';
    public $timestamps = false;
    protected $connection = 'production';

    public function product()
    {
        return $this->belongsTo('App\Product', 'pcode', 'id');
    }

    public function getPriceFormatAttribute()
    {
        return Functions::formatCurrency($this->price);
    }
}
