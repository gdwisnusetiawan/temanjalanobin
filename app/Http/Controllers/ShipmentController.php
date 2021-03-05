<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function jntOrder()
    {
        $url = env('JNT_ORDER_URL');
        $key = env('JNT_ORDER_KEY');
        $data = [
            'username' => 'TUTOYA',
            'api_key' => 'tes123',
            'orderid' => 'TUTOYA-0001',
            'shipper_name' => 'PENGIRIM',
            'shipper_contact' => 'PENGIRIM',
            'shipper_phone' =>  '+628123456789',
            'shipper_addr' => 'JL. Pengirim no.88, RT/RW:001/010, Pluit',
            'origin_code' => 'MES',
            'receiver_name' => 'PENERIMA',
            'receiver_phone' => '+62812348888',
            'receiver_addr' => 'JL. Penerima no.1, RT/RW:04/07, Sidoarjo',
            'receiver_zip' => '40123',
            'destination_code' => 'SDA',
            'receiver_area' => 'SDA001',
            'qty' => '1',
            'weight' => '1',
            'goodsdesc' => 'TESTING!!',
            'servicetype' => '1',
            'insurance' => '50000',
            'orderdate' => '2017–08-01 22:02:00',
            'item_name' => 'topi',
            'cod' => '200000',
            'sendstarttime' => '2017-08-01 08:00:00',
            'sendendtime' => '2017-08-01 22:00:00',
            'expresstype' => '1',
            'goodsvalue' => '1000'
        ];
        $data_json = json_encode(['detail' => [$data]]);
        $data_request = [
            'data_param' => $data_json,
            'data_sign' => base64_encode(md5($data_json.$key))
        ];
        $response = Http::asForm()->post($url, $data_request);
        $result = json_decode($response->body());
        dd($result);
        return response()->json($result);
    }

    public function jntCost()
    {
        $url = env('JNT_TARIF_URL');
        $key = env('JNT_TARIF_KEY');
        $data_key = [
            'cusName' => 'TUTOYA',
            'sendSiteCode' => 'JAKARTA',
            'destAreaCode' => 'KALIDERES',
            'weight' => 1.31,
            'productType' => 'EZ'
        ];
        $data_request = [
            'data' => json_encode($data_key),
            'sign' => base64_encode(md5(json_encode($data_key).$key))
        ];
        $response = Http::asForm()->post($url, $data_request);
        $result = json_decode($response->body());
        dd($result);
        return response()->json($result);
    }

    public function jntTrack()
    {
        $url = env('JNT_TRACK_URL');
        $username = env('JNT_TRACK_USERNAME');
        $password = env('JNT_TRACK_PASSWORD');
        $awb = 'JO0027401189';
        $data_request = [
            'awb' => $awb,
            'eccompanyid' => $username
        ];
        $response = Http::withBasicAuth($username, $password)->post($url, $data_request);
        $result = json_decode($response->body());
        dd($result);
        return response()->json($result);
    }

    public function ncsCost()
    {
        $base_url = env('NCS_URL');
        $username = env('NCS_USERNAME');
        $password = env('NCS_PASSWORD');
        $data_request = [
            'origin' => 'SUB3578',
            'destination' => 'MDN3577'
        ];
        $url = "$base_url/$username/$password";
        $response = Http::get($url, $data_request);
        $result = json_decode($response->body());
        dd($result);
        return response()->json($result);
    }

    public function rajaongkirProvince($id = null)
    {
        $url = env('RAJAONGKIR_API_URL');
        $key = env('RAJAONGKIR_API_KEY');
        $response = Http::withHeaders([
            'key' => $key
            ])->asForm()->get($url.'/province?id='.$id);
        $result = json_decode($response->body())->rajaongkir->results;
        // dd($result);
        return response()->json($result);
    }

    public function rajaongkirCity($province, $id = null)
    {
        $url = env('RAJAONGKIR_API_URL');
        $key = env('RAJAONGKIR_API_KEY');
        $response = Http::withHeaders([
            'key' => $key
            ])->asForm()->get($url.'/city?province='.$province.'&id='.$id);
        $result = json_decode($response->body())->rajaongkir->results;
        // dd($result);
        return response()->json($result);
    }

    public function rajaongkirCost(Request $request)
    {
        $url = env('RAJAONGKIR_API_URL');
        $key = env('RAJAONGKIR_API_KEY');
        $couriers = ['pos','jne','tiki'];
        foreach($couriers as $courier) {
            $response = Http::withHeaders([
                'key' => $key
                ])->asForm()->post($url.'/cost', [
                    'origin' => $request->origin,
                    'destination' => $request->destination,
                    'weight' => $request->weight > 0 ? $request->weight : 1,
                    'courier' => $courier,
                ]);
            $results[] = json_decode($response->body())->rajaongkir->results;
        }
        // dd($results);
        return response()->json($results);
    }
}
