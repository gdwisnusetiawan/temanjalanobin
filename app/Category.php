<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    public $timestamps = false;
    protected $connection = 'master';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory', 'subcat', 'id');
    }

    // public function products()
    // {
    //     return $this->hasMany('App\Product', "'category", 'id');
    // }

    public function getProductsAttribute()
    {
        return Product::where('category', $this->id)->get();
    }
    
    // public function getSlugAttribute()
    // {
    //     return Str::slug($this->title, '-');
    // }
    
    public function getTitleAttribute($value)
    {
        return Functions::translate($value);
    }

    public function getSlugAttribute($value)
    {
        return Functions::translate($value);
    }
}
