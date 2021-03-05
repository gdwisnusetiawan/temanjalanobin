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

    public function variants()
    {
        return $this->hasMany('App\Variant', 'product_id', 'id');
    }

    public function distributor()
    {
        return $this->belongsTo('App\Distributor');
    }

    public function subinventories()
    {
        return $this->hasMany('App\Subinventory', 'productid', 'id');
    }

    public function getSubinventoryAttribute()
    {
        return $this->subinventories->sortByDesc('date_time')->first();
    }
    
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

    public function getRealPriceAttribute()
    {
        return Functions::formatCurrency($this->price);
    }

    public function getPriceFormat($quantity = 1)
    {
        return Functions::formatCurrency($this->getUserPrice($quantity));
    }

    public function getUserPrice($quantity)
    {
        if(auth()->check() && auth()->user()->pricing($this->id)->isNotEmpty())
        {
            $user_pricing = auth()->user()->pricing($this->id);
            $pricing = $user_pricing->where('startamount', '<=', $quantity)->where('endamount', '>=', $quantity)->first();
            if($pricing == null) {
                $endamount = $user_pricing->max('endamount');
                $startamount = $user_pricing->min('startamount');
                if($quantity >= $endamount) {
                    $price = $user_pricing->where('endamount', '>=', $endamount)->first()->price;
                }
                elseif($quantity <= $startamount) {
                    $price = $user_pricing->where('startamount', '<=', $startamount)->first()->price;
                }
            }
            else {
                $price = $pricing->price;
            }
        }
        else
        {
            $price = $this->price;
        }
        return $price - $this->discount;
    }

    public function getDiscountAttribute()
    {
        $discount = 0;
        if($this->discount_value != null) {
            $discount = $this->discount_value;
        }
        elseif($this->discount_percent != null) {
            $discount = round($this->price * $this->discount_percent / 100, 2);
        }
        return $discount;
    }
}
