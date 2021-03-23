<?php

namespace App\Helpers;

use App\Menu;
use App\Ip;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

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
        $cdn = env('APP_STORAGE_URL').'foto/';
        $classname = strtolower(class_basename($model));
        if($classname == 'config') {
            $classname = 'general';
        }
        elseif(in_array($classname, ['page', 'multipage', 'multisubpage'])) {
            $classname = $classname.'s';
        }
        $url = $cdn.$classname.'/'.$model->id.'/';

        $table_columns = Functions::tableColumns($model);
        $image_count = collect($table_columns)->filter(function ($value, $key) {
            return Str::contains($value, 'image');
        })->count();
        $images = [];
        for ($i=1; $i <= $image_count; $i++) {
            if($model->{'image'.$i} != null) {
                $images[] = $url.'image'.$i;
            }
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
                // $media['url'][] = asset('polo-5/images/blog/1.jpg');
                $media['url'][] = asset('img/no-image.png');
            }
            elseif(in_array(class_basename($model), ['Product'])) {
                // $media['url'][] = asset('polo-5/images/shop/products/1.jpg');
                $media['url'][] = asset('img/no-image.png');
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

    public static function ipApi($ip)
    {
        $url = "http://ip-api.com/json/$ip";
        $response = Http::get($url, [
            'fields' => 'status,message,continent,continentCode,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,offset,currency,isp,org,as,asname,reverse,mobile,proxy,hosting,query',
        ]);
        return json_decode($response->body());
    }

    public static function getIp($ip)
    {
        $ip_model = Ip::where('ip', '203.78.117.158')->orderBy('date_time', 'desc')->first();
        if($ip_model == null) {
            $ip_response = self::ipApi($ip);
            $ip_new = new Ip();
            $ip_new->ip = $ip_response->query;
            $ip_new->status = $ip_response->status;
            $ip_new->continent = $ip_response->continent;
            $ip_new->continentcode = $ip_response->continentCode;
            $ip_new->country = $ip_response->country;
            $ip_new->countrycode = $ip_response->countryCode;
            $ip_new->region = $ip_response->region;
            $ip_new->regionname = $ip_response->regionName;
            $ip_new->city = $ip_response->city;
            $ip_new->district = $ip_response->district;
            $ip_new->zip = $ip_response->zip;
            $ip_new->lat = $ip_response->lat;
            $ip_new->lon = $ip_response->status;
            $ip_new->timezone = $ip_response->timezone;
            $ip_new->timezoneoffset = $ip_response->offset;
            $ip_new->currency = $ip_response->currency;
            $ip_new->isp = $ip_response->isp;
            $ip_new->org = $ip_response->org;
            $ip_new->asnumber = $ip_response->as;
            $ip_new->asname = $ip_response->asname;
            $ip_new->reverse = $ip_response->reverse;
            $ip_new->mobile = $ip_response->mobile;
            $ip_new->proxy = $ip_response->proxy;
            $ip_new->hosting = $ip_response->hosting;
            $ip_new->token = md5(uniqid(rand(), true));
            $ip_new->date_time = gmdate("Y-m-d\TH:i:s\Z");
            $ip_new->is_processed = false;
            $ip_new->save();
            $ip_model = $ip_new;
        }
        return $ip_model;
        // dd($ip_response);
    }
}
