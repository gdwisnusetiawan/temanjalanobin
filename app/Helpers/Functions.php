<?php

namespace App\Helpers;

use App\Menu;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Functions
{
    public static function menu()
    {
        $all_menus = Menu::where('is_active', true)->get();
        $half = ceil($all_menus->count() / 2);
        $menus = $all_menus->chunk($half);
        return $menus;
    }

    public static function tableColumns($model)
    {
        // return \DB::connection()->getSchemaBuilder()->getColumnListing('footer');
        return $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
    }

    public static function datetimeFormat($datetime)
    {
        return Carbon::parse($datetime)->format('F jS, Y');
    }

    public static function datetimeDiff($datetime)
    {
        return Carbon::parse($datetime)->diffForHumans();
    }

    // public static function media($model)
    // {
    //     $img_folder = '/img/';
    //     $table_columns = Functions::tableColumns($model);
    //     $image_count = collect($table_columns)->filter(function ($value, $key) {
    //         return Str::contains($value, 'image');
    //     })->count();
    //     $images = [];
    //     for ($i=1; $i <= $image_count; $i++) {
    //         if(Str::startsWith($model->{'image'.$i}, 'http')) {
    //             $images[] = $model->{'image'.$i};
    //         }
    //         elseif(is_file(public_path().($img_folder.$model->{'image'.$i}))) {
    //             $images[] = asset($img_folder.$model->{'image'.$i});
    //         }
    //     }
    //     if($model->video != null) {
    //         $media['type'] = 'video';
    //         if(Str::startsWith($model->video, 'http')) {
    //             $media['url'] = $model->video;
    //         }
    //         else {
    //             $media['url'] = is_file(public_path().($model->video)) ? asset($model->video) : '';
    //         }
    //     }
    //     elseif($model->audio != null) {
    //         $media['type'] = 'audio';
    //         if(Str::startsWith($model->audio, 'http')) {
    //             $media['url'] = $model->audio;
    //         }
    //         else {
    //             $media['url'] = is_file(public_path().($model->audio)) ? asset($model->audio) : '';
    //         }
    //     }
    //     elseif(count($images) > 0) {
    //         $media['type'] = 'image';
    //         $media['url'] = $images;
    //     }
    //     else {
    //         $media['type'] = 'image';
    //         if(in_array(class_basename($model), ['Page', 'Multipage', 'Multisubpage'])) {
    //             $media['url'][] = asset('polo-5/images/blog/1.jpg');
    //         }
    //         elseif(in_array(class_basename($model), ['Product'])) {
    //             $media['url'][] = asset('polo-5/images/shop/products/1.jpg');
    //         }
    //         $media[] = $media;
    //     }
    //     return $media;
    // }

    public static function media($model)
    {
        $cdn = 'acp.pasarama.com/foto';
        $classname = strtolower(class_basename($model));
        if($classname == 'config') {
            $classname = 'general/';
        }
        $url = $cdn.$classname.$model->id.'/';

        $table_columns = Functions::tableColumns($model);
        $image_count = collect($table_columns)->filter(function ($value, $key) {
            return Str::contains($value, 'image');
        })->count();
        $images = [];
        for ($i=1; $i <= $image_count; $i++) {
            $images[] = $url.'image'.$i;
        }
        if($model->video != null) {
            $media['type'] = 'video';
            $media['url'] = $url.'video';
        }
        elseif($model->audio != null) {
            $media['type'] = 'audio';
            $media['url'] = $url.'audio';
        }
        elseif(count($images) > 0) {
            $media['type'] = 'image';
            $media['url'] = $images;
        }
        else {
            $media['type'] = 'image';
            if(in_array(class_basename($model), ['Page', 'Multipage', 'Multisubpage'])) {
                $media['url'][] = asset('polo-5/images/blog/1.jpg');
            }
            elseif(in_array(class_basename($model), ['Product'])) {
                $media['url'][] = asset('polo-5/images/shop/products/1.jpg');
            }
            $media[] = $media;
        }
        return $media;
    }

    public static function paragraphChunk($paragraph)
    {
        return Str::words(strip_tags(htmlspecialchars_decode($paragraph)), 20, ' . . .');
    }

    public static function formatCurrency($price, $currency = 'Rp')
    {
        return $currency.number_format($price,2,',','.');
    }

    public static function shareLink($url, $text = '')
    {
        $facebook = "https://www.facebook.com/sharer/sharer.php?u=$url";
        $twitter = "https://twitter.com/intent/tweet?url=$url&text=$text";
        $linkedin = "http://www.linkedin.com/shareArticle?mini=true&url=$url&title=$text";
        $whatsapp = "https://wa.me/?text=$text $url";
        return [
            'facebook' => $facebook,
            'twitter' => $twitter,
            'linkedin' => $linkedin,
            'whatsapp' => $whatsapp
        ];
    }
}
