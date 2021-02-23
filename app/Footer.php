<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $table = 'footer';
    public $timestamps = false;
    protected $connection = 'web';

    // public function getContentsAttribute()
    // {
    //     $table_columns = Functions::tableColumns($this);
    //     $rows = collect($table_columns)->filter(function ($value, $key) {
    //         return Str::contains($value, 'description');
    //     })->count();
    //     $columns = 8;
    //     $contents = [];
    //     for ($i=1; $i <= $rows; $i++) {
    //         $type = 'default';
    //         if(strpos( strtolower($this->{'title'.$i.'0'}), 'newsletter' ) !== false) {
    //             $type = 'newsletter';
    //         }
    //         $contents[$type][$i]['title'] = $this->{'title'.$i.'0'};
    //         $contents[$type][$i]['description'] = $this->{'description'.$i};
    //         for ($j=1; $j <= $columns; $j++) {
    //             $location = $this->{'location'.$i.$j};
    //             if(!Str::startsWith($location, 'http') && $location != null) {
    //                 $location = route('page.index', $location);
    //             }
    //             $contents[$type][$i]['links'][$j] = [
    //                 'title' => $this->{'title'.$i.$j},
    //                 'location' => $this->{'location'.$i.$j},
    //             ];
    //         }
    //     }
    //     return $contents;
    // }

    public function getContentsAttribute()
    {
        $table_columns = Functions::tableColumns($this);
        $rows = collect($table_columns)->filter(function ($value, $key) {
            return Str::contains($value, 'description');
        })->count();
        $columns = 8;
        $contents = [];
        for ($i=1; $i <= $rows; $i++) {
            $type = 'default';
            if(strpos( strtolower($this->{'title'.$i}), 'newsletter' ) !== false && $this->newsletter) {
                $type = 'newsletter';
            }
            $contents[$type][$i]['title'] = $this->{'title'.$i};
            $contents[$type][$i]['description'] = $this->{'description'.$i};
        }
        return $contents;
    }
}
