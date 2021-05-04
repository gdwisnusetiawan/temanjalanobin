<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Helpers\Shipment;

class ShipmentController extends Controller
{
    public function jntOrder(Request $request)
    {
        $response = Shipment::jntOrder($request);
        $result = json_decode($response->body());
        // dd($result);
        return response()->json($result);
    }

    public function jntCost(Request $request)
    {
        $response = Shipment::jntCost($request);
        $result = json_decode($response->body());
        // dd($result);
        return response()->json($result);
    }

    public function jntTrack()
    {
        $response = Shipment::jntTrack($request);
        $result = json_decode($response->body());
        // dd($result);
        return response()->json($result);
    }

    public function ncsCost()
    {
        $response = Shipment::ncsCost($request);
        $result = json_decode($response->body());
        // dd($result);
        return response()->json($result);
    }

    public function ncsPickup(Request $request)
    {
        $response = Shipment::ncsPickup($request);
        $result = json_decode($response->body());
        // dd($result);
        return response()->json($result);
    }

    public function ncsTrack(Request $request)
    {
        $response = Shipment::ncsTrack($request);
        $result = json_decode($response->body());
        // dd($result);
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

    public function rajaongkirSubdistrict($city, $id = null)
    {
        $response = Shipment::rajaongkirSubdistrict($city, $id);
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

    public function rajaongkirCountry($id = null)
    {
        $response = Shipment::rajaongkirCountry($id);
        $result = json_decode($response->body())->rajaongkir->results;
        // dd($result);
        return response()->json($result);
    }

    public function rajaongkirInternationalCost(Request $request)
    {
        $results = Shipment::rajaongkirInternationalCost($request);
        // dd($results);
        return response()->json($results);
    }
}
