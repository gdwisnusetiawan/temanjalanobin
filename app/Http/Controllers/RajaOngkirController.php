<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class RajaOngkirController extends Controller
{
    public function province($id = null)
    {
        $response = Http::withHeaders([
            'content-type' => 'application/x-www-form-urlencoded',
            'key' => 'a668420368d4731d3ca94321058bcea2'
            ])->get('https://api.rajaongkir.com/starter/province?id='.$id);
        $result = json_decode($response->body())->rajaongkir->results;
        return response()->json($result);
    }

    public function city($province, $id = null)
    {
        $response = Http::withHeaders([
            'content-type' => 'application/x-www-form-urlencoded',
            'key' => 'a668420368d4731d3ca94321058bcea2'
            ])->get('https://api.rajaongkir.com/starter/city?province='.$province.'&id='.$id);
        $result = json_decode($response->body())->rajaongkir->results;
        return response()->json($result);
    }

    public function cost()
    {
        // $response = Http::withHeaders([
        //     'content-type' => 'application/x-www-form-urlencoded',
        //     'key' => 'a668420368d4731d3ca94321058bcea2'
        //     ])->get('https://api.rajaongkir.com/starter/province');
        // $result = json_decode($response->body())->rajaongkir->results;
        // dd($result);
    }
}
