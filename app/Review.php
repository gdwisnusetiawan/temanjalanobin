<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';
    public $timestamps = false;
    protected $connection = 'master';
    protected $guarded = [];
    protected $casts = [
        'rating' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'productid', 'id');
    }

    public function customer()
    {
        return $this->belongsTo('App\User', 'customerid', 'id');
    }

    public function getDatetimeFormatAttribute()
    {
        return Functions::datetimeFormat($this->datetime);
    }
}
