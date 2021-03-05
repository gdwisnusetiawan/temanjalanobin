<?php

namespace App\Http\Controllers;

use App\Helpers\Shipment;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function jntOrder(Request $request)
    {
        $response = Shipment::jntOrder($request);
        $result = json_decode($response->body());
        dd($result);
        return response()->json($result);
    }

    public function jntCost(Request $request)
    {
        $response = Shipment::jntCost($request);
        $result = json_decode($response->body());
        // dd(json_decode($result->content));
        return response()->json($result);
    }

    public function jntTrack(Request $request)
    {
        $response = Shipment::jntTrack($request);
        $result = json_decode($response->body());
        dd($result);
        return response()->json($result);
    }

    public function ncsCost(Request $request)
    {
        $response = Shipment::ncsCost($request);
        $result = json_decode($response->body());
        dd($result);
        return response()->json($result);
    }

    public function ncsTrack()
    {
        $response = Shipment::ncsTrack($request);
        $result = json_decode($response->body());
        dd($result);
        return response()->json($result);
    }

    public function rajaongkirProvince($id = null)
    {
        $response = Shipment::rajaongkirProvince($id);
        $result = json_decode($response->body())->rajaongkir->results;
        // dd($result);
        return response()->json($result);
    }

    public function rajaongkirCity($province, $id = null)
    {
        $response = Shipment::rajaongkirCity($province, $id);
        $result = json_decode($response->body())->rajaongkir->results;
        // dd($result);
        return response()->json($result);
    }

    public function rajaongkirCost(Request $request)
    {
        $results = Shipment::rajaongkirCost($request);
        // dd($results);
        return response()->json($results);
    }
}
