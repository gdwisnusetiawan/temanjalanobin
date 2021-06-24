<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    public $timestamps = false;
    protected $connection = 'web';

    public function page()
    {
        return $this->hasOne('App\Page', 'menuid', 'id');
    }

    public function multipage()
    {
        return $this->hasOne('App\Multipage', 'menuid', 'id');
    }

    public function getSlugAttribute()
    {
        if($this->page) {
            $slug = $this->page->slug;
        }
        elseif($this->multipage) {
            $slug = $this->multipage->slug;
        }
        else {
            $slug = Str::slug($this->title, '-');
            // $slug = str_replace(' ', '-', $this->title);
        }
        return $slug;
    }

    public function getUrlAttribute()
    {
        return $this->slug ? route('page.index', $this->slug) : url($this->slug);
    }

    public function getTitleAttribute($value)
    {
        return Functions::translate($value);
    }

    // public function getSubmenusAttribute()
    // {
    //     $submenuids = explode(',', $this->submenu);
    //     $submenus = Menu::whereIn('id', $submenuids)->get();
    //     $submenus = Menu::where('submenu', $this->id)->get();
    //     return $submenus;
    // }

    public function submenus()
    {
        return $this->hasMany('App\Menu', 'submenu', 'id');
    }

    public function isContains($column, $words)
    {
        return Str::contains(strtolower($this->{$column}), $words);
    }

    public function isMegaMenu()
    {
        return $this->submenus->count() > 8 || $this->hasCategory();
        // return $this->submenus->count() > 8;
    }

    public function hasCategory()
    {
        return $this->isContains('title', ['belanja', 'shop', 'categories', 'tour', 'kategori']) || $this->id == 2;
    }
}