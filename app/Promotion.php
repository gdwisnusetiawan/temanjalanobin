<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotion';
    public $timestamps = false;
    protected $connection = 'web';

    public function getLinksAttribute()
    {
        if($this->link1) {
            if(Str::startsWith($this->link, 'http')) {
                $links[0] = $this->link;
            }
            else {
                $links[0] = route('page.index', $this->link);
            }
        }
        else {
            $links[0] = '#';
        }

        if($this->link2) {
            if(Str::startsWith($this->link, 'http')) {
                $links[1] = $this->link;
            }
            else {
                $links[1] = route('page.index', $this->link);
            }
        }
        else {
            $links[1] = '#';
        }
        return $links;
    }

    public function getMediaAttribute()
    {
        return Functions::media($this);
    }

    public function getTitle1Attribute($value)
    {
        return Functions::translate($value);
    }

    public function getDescription1Attribute($value)
    {
        return Functions::translate($value);
    }

    public function getButton1Attribute($value)
    {
        return Functions::translate($value);
    }

    public function getLink1Attribute($value)
    {
        return Functions::translate($value);
    }

    public function getTitle2Attribute($value)
    {
        return Functions::translate($value);
    }

    public function getDescription2Attribute($value)
    {
        return Functions::translate($value);
    }

    public function getButton2Attribute($value)
    {
        return Functions::translate($value);
    }

    public function getLink2Attribute($value)
    {
        return Functions::translate($value);
    }
}
