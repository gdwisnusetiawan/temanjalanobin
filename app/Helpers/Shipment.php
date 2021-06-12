<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class Shipment
{
    public static function jntOrder(Request $request)
    {
        $url = config('services.jnt.order.url');
        $username = config('services.jnt.order.username');
        $key = config('services.jnt.order.key');
        $api_key = config('services.jnt.order.api_key');
        $data = [
            'username' => $username,
            'api_key' => $api_key,
            'orderid' => $request->orderid,
            'shipper_name' => $request->shipper_name,
            'shipper_contact' => $request->shipper_contact,
            'shipper_phone' =>  $request->shipper_phone,
            'shipper_addr' => $request->shipper_addr,
            'origin_code' => $request->origin_code,
            'receiver_name' => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'receiver_addr' => $request->receiver_addr,
            'receiver_zip' => $request->receiver_zip,
            'destination_code' => $request->destination_code,
            'receiver_area' => $request->receiver_area,
            'qty' => $request->qty,
            'weight' => $request->weight,
            'goodsdesc' => $request->goodsdesc,
            'servicetype' => $request->servicetype,
            'insurance' => $request->insurance,
            'orderdate' => $request->orderdate,
            'item_name' => $request->item_name,
            'sendstarttime' => $request->sendstarttime,
            'sendendtime' => $request->sendendtime,
            'expresstype' => $request->expresstype,
            'goodsvalue' => $request->goodsvalue
        ];
        $data_json = json_encode(['detail' => [$data]]);
        $data_request = [
            'data_param' => $data_json,
            'data_sign' => base64_encode(md5($data_json.$key))
        ];
        $response = Http::asForm()->post($url, $data_request);

        $log = [
            'URI' => $url,
            'METHOD' => 'POST',
            'REQUEST_BODY' => $data_request,
            'RESPONSE' => $response->body()
        ];
        Log::info(json_encode($log));
        return $response;
    }

    public static function jntCost(Request $request)
    {
        $url = config('services.jnt.tarif.url');
        $key = config('services.jnt.tarif.key');
        $cusname = config('services.jnt.tarif.cusname');
        $productType = 'EZ';
        $data_key = [
            'cusName' => $cusname,
            'sendSiteCode' => $request->sendSiteCode,
            'destAreaCode' => $request->destAreaCode,
            'weight' => $request->weight,
            'productType' => $productType
        ];
        $data_request = [
            'data' => json_encode($data_key),
            'sign' => base64_encode(md5(json_encode($data_key).$key))
        ];
        $response = Http::asForm()->post($url, $data_request);
        
        $log = [
            'URI' => $url,
            'METHOD' => 'POST',
            'REQUEST_BODY' => $data_request,
            'RESPONSE' => $response->body()
        ];
        Log::info(json_encode($log));
        return $response;
    }

    public static function jntTrack(Request $request)
    {
        $url = config('services.jnt.track.url');
        $username = config('services.jnt.track.username');
        $password = config('services.jnt.track.password');
        // $awb = 'JO0027401200';
        $awb = $request->awb;
        $data_request = [
            'awb' => $awb,
            'eccompanyid' => $username
        ];
        $response = Http::withBasicAuth($username, $password)->post($url, $data_request);
        
        $log = [
            'URI' => $url,
            'METHOD' => 'POST',
            'REQUEST_BODY' => $data_request,
            'RESPONSE' => $response->body()
        ];
        Log::info(json_encode($log));
        return $response;
    }

    public static function ncsCost(Request $request)
    {
        $base_url = config('services.ncs.url');
        $username = config('services.ncs.username');
        $password = config('services.ncs.password');
        $data_request = [
            'origin' => $request->origin,
            'destination' => $request->destination
        ];
        $url = "$base_url/checkprice/$username/$password";
        $response = Http::get($url, $data_request);
        return $response;
    }

    public static function ncsPickup(Request $request)
    {
        $base_url = config('services.ncs.url');
        $username = config('services.ncs.username');
        $password = config('services.ncs.password');
        $data_request = [
            "accno" => $request->accno,
            "comname" => $request->comname,
            "pickpoint" => $request->pickpoint,
            "pickaddress" => $request->pickaddress,
            "pickcp" => $request->pickcp,
            "pickphone" => $request->pickphone,
            "pickkecid" => $request->pickkecid,
            "pickzip" => $request->pickzip,
            "pickdate" => $request->pickdate,
            "pickemail" => $request->pickemail,
            "picktimefrom" => $request->picktimefrom,
            "picktimeto" => $request->picktimeto,
            "picktransport" => $request->picktransport,
            "si" => $request->si,
            "transaction" => $request->transaction
        ];
        // $data_request = json_decode($data);
        $url = "$base_url/picktranscargo/$username/$password";
        $response = Http::post($url, $data_request);
        return $response;
    }

    public static function ncsTrack(Request $request)
    {
        $base_url = config('services.ncs.url');
        $username = config('services.ncs.username');
        $password = config('services.ncs.password');
        $data_request = [
            // 'awb' => $request->awb,
            'awb' => '3122001543318',
            // 'refno' => '3122001543318',
        ];
        $url = "$base_url/trackingcomplete/$username/$password";
        $response = Http::get($url, $data_request);
        return $response;
    }

    public static function rajaongkirProvince($id = null)
    {
        $url = config('services.rajaongkir.url');
        $key = config('services.rajaongkir.key');
        $response = Http::withHeaders([
            'key' => $key
            ])->asForm()->get($url.'/province?id='.$id);
        return $response;
    }

    public static function rajaongkirCity($province, $id = null)
    {
        $url = config('services.rajaongkir.url');
        $key = config('services.rajaongkir.key');
        $response = Http::withHeaders([
            'key' => $key
            ])->asForm()->get($url.'/city?province='.$province.'&id='.$id);
        return $response;
    }

    public static function rajaongkirSubdistrict($city, $id = null)
    {
        $url = config('services.rajaongkir.url');
        $key = config('services.rajaongkir.key');
        $response = Http::withHeaders([
            'key' => $key
            ])->asForm()->get($url.'/subdistrict?city='.$city.'&id='.$id);
        return $response;
    }

    public static function rajaongkirCost(Request $request)
    {
        $url = config('services.rajaongkir.url');
        $key = config('services.rajaongkir.key');
        $couriers = ['pos','jne','tiki'];
        foreach($couriers as $courier) {
            $response = Http::withHeaders([
                'key' => $key
                ])->asForm()->post($url.'/cost', [
                    'origin' => $request->origin,
                    'originType' => 'city',
                    'destination' => $request->destination,
                    'destinationType' => 'city',
                    'weight' => $request->weight > 0 ? $request->weight : 1,
                    'courier' => $courier,
                ]);
            $results[] = json_decode($response->body())->rajaongkir->results;
        }
        return $results;
    }

    public static function rajaongkirCountry($id = null)
    {
        $url = config('services.rajaongkir.url_v2');
        $key = config('services.rajaongkir.key');
        $response = Http::withHeaders([
            'key' => $key
            ])->asForm()->get($url.'/internationalDestination?id='.$id);
        return $response;
    }

    public static function rajaongkirInternationalCost(Request $request)
    {
        $url = config('services.rajaongkir.url_v2');
        $key = config('services.rajaongkir.key');
        $couriers = ['pos','slis','expedito'];
        foreach($couriers as $courier) {
            $response = Http::withHeaders([
                'key' => $key
                ])->asForm()->post($url.'/internationalCost', [
                    'origin' => $request->origin,
                    'destination' => $request->destination,
                    'weight' => $request->weight > 0 ? $request->weight : 1,
                    'courier' => $courier,
                ]);
            $results[] = json_decode($response->body())->rajaongkir->results;
        }
        return $results;
    }
}
