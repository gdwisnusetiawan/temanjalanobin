<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    public $timestamps = false;
    protected $connection = 'master';
    protected $casts = [
        'category' => 'integer',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // public function category()
    // {
    //     return $this->belongsTo('App\Category', 'category', 'id');
    // }
    
    public function getCategoryModelAttribute()
    {
        return Category::find($this->category);
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->title, '-');
    }

    public function getMediaAttribute()
    {
        return Functions::media($this);
    }

    public function getPriceFormatAttribute()
    {
        // return 'Rp'.number_format($this->price,2,',','.');
        return Functions::formatCurrency($this->price);
    }
}
