<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class Shipment
{
    public static function jntOrder(Request $request)
    {
        $url = env('JNT_ORDER_URL');
        $key = env('JNT_ORDER_KEY');
        // $data = [
        //     'username' => 'TUTOYA',
        //     'api_key' => 'tes123',
        //     'orderid' => 'TUTOYA-0006',
        //     'shipper_name' => 'PENGIRIM',
        //     'shipper_contact' => 'PENGIRIM',
        //     'shipper_phone' =>  '+628123456789',
        //     'shipper_addr' => 'JL. Pengirim no.88, RT/RW:001/010, Pluit',
        //     'origin_code' => 'MES',
        //     'receiver_name' => 'PENERIMA',
        //     'receiver_phone' => '+62812348888',
        //     'receiver_addr' => 'JL. Penerima no.1, RT/RW:04/07, Sidoarjo',
        //     'receiver_zip' => '40123',
        //     'destination_code' => 'SDA',
        //     'receiver_area' => 'SDA001',
        //     'qty' => '1',
        //     'weight' => '1',
        //     'goodsdesc' => 'TESTING!!',
        //     'servicetype' => '1',
        //     'insurance' => '50000',
        //     'orderdate' => '2017–08-01 22:02:00',
        //     'item_name' => 'topi',
        //     'cod' => '200000',
        //     'sendstarttime' => '2017-08-01 08:00:00',
        //     'sendendtime' => '2017-08-01 22:00:00',
        //     'expresstype' => '1',
        //     'goodsvalue' => '1000'
        // ];
        $data = [
            'username' => $request->username,
            'api_key' => $request->api_key,
            'orderid' => $request->orderid,
            'shipper_name' => $request->shipper_name,
            'shipper_contact' => $request->shipper_contact,
            'shipper_phone' =>  $request->shipper_contact,
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
            'cod' => $request->cod,
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
        return $response;
    }

    public static function jntCost(Request $request)
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
        // $data_key = [
        //     'cusName' => $request->cusName,
        //     'sendSiteCode' => $request->sendSiteCode,
        //     'destAreaCode' => $request->destAreaCode,
        //     'weight' => $request->weight,
        //     'productType' => $request->productType
        // ];
        $data_request = [
            'data' => json_encode($data_key),
            'sign' => base64_encode(md5(json_encode($data_key).$key))
        ];
        $response = Http::asForm()->post($url, $data_request);
        return $response;
    }

    public static function jntTrack(Request $request)
    {
        $url = env('JNT_TRACK_URL');
        $username = env('JNT_TRACK_USERNAME');
        $password = env('JNT_TRACK_PASSWORD');
        // $awb = 'JO0027401200';
        $awb = $request->awb;
        $data_request = [
            'awb' => $awb,
            'eccompanyid' => $username
        ];
        $response = Http::withBasicAuth($username, $password)->post($url, $data_request);
        return $response;
    }

    public static function ncsCost(Request $request)
    {
        $base_url = env('NCS_URL');
        $username = env('NCS_USERNAME');
        $password = env('NCS_PASSWORD');
        // $data_request = [
        //     'origin' => 'SUB3578',
        //     'destination' => 'MDN3577'
        // ];
        $data_request = [
            'origin' => $request->origin,
            'destination' => $request->destination
        ];
        $url = "$base_url/checkprice/$username/$password";
        $response = Http::get($url, $data_request);
        return $response;
    }

    public static function ncsTrack(Request $request)
    {
        $base_url = env('NCS_URL');
        $username = env('NCS_USERNAME');
        $password = env('NCS_PASSWORD');
        $data_request = [
            "accno" => "4231731000300055",
            "comname" => "NCS TEST",
            "pickpoint" => "PT. Nusantara Card Semesta",
            "pickaddress" => "Jl. Brigjend Katamso No. 7, Kec. Palmerah, Kel. Kota Bambu Selatan, Jakarta Barat, Provinsi DKI Jakarta",
            "pickcp" => "LIA",
            "pickphone" => "021-3865971",
            "pickkecid" => "317404",
            "pickzip" => "11420",
            "pickdate" => "2020-08-14",
            "pickemail" => "lia@toko.co.id",
            "picktimefrom" => "08:00",
            "picktimeto" => "10:00",
            "picktransport" => "101",
            "si" => "tolong jangan di banting",
            "transaction" => [
                [
                    "refno" => "trx1812060020",
                    "s_add1" => "Jl. Brigjend. Katamso No.7",
                    "s_add2" => "Palmerah",
                    "s_add3" => "Jakarta Barat",
                    "s_add4" => "DKI Jakarta",
                    "s_kecid" => "317308",
                    "s_zip" => "11610",
                    "s_phnno" => "0215829191",
                    "s_email" => "user@toko.co.id",
                    "c_cnename" => "RIZAL",
                    "c_add1" => "POLITEKNIK ILMU PELAYARAN SEMARANGJL.SINGOSARI 2A,",
                    "c_add2" => "SEMARANG SELATAN",
                    "c_add3" => "KOTA SEMARANG",
                    "c_add4" => "JAWA TENGAH",
                    "c_kecid" => "337407",
                    "c_zip" => "50242",
                    "c_phnno" => "081281552xxx",
                    "c_email" => "rizal@gmail.com",
                    "value" => 0,
                    "service" => "ONS",
                    "specinstruction" => "tolong jangan dibanting",
                    "weight" => 3,
                    "vweight" => 6,
                    "content" => "Otak-otak Frozen",
                    "pieces" => 2,
                    "FlagNFD" => 1,
                    "Length" => 31,
                    "Width" => 35,
                    "Height" => 12,
                    "DeliveryPrice" => 25000,
                    "insuranceprice" => 0,
                    "CODType" => ""
                ],
                [
                    "refno" => "trx1812060026",
                    "s_add1" => "Jl. Brigjend. Katamso No.7",
                    "s_add2" => "Palmerah",
                    "s_add3" => "Jakarta Barat",
                    "s_add4" => "DKI Jakarta",
                    "s_kecid" => "317308",
                    "s_zip" => "11610",
                    "s_phnno" => "0215829191",
                    "s_email" => "user@toko.co.id",
                    "c_cnename" => "ANDI",
                    "c_add1" => "RSUD SEMARANG, Jl Jend. Sudirman 51,",
                    "c_add2" => "SEMARANG SELATAN",
                    "c_add3" => "KOTA SEMARANG",
                    "c_add4" => "JAWA TENGAH",
                    "c_kecid" => "337407",
                    "c_zip" => "50242",
                    "c_phnno" => "081281435xxx",
                    "c_email" => "andi@gmail.com",
                    "value" => 500000,
                    "service" => "NRS",
                    "specinstruction" => "barang pecah belah",
                    "weight" => 3,
                    "vweight" => 14,
                    "content" => "ALAT RAPIT TEST - PUTIH",
                    "pieces" => 10,
                    "FlagNFD" => 0,
                    "Length" => 33,
                    "Width" => 24,
                    "Height" => 13,
                    "DeliveryPrice" => 25000,
                    "insuranceprice" => 8000,
                    "CODType" => "cod"
                ]
            ]
        ];
        // $data_request = json_decode($data);
        $url = "$base_url/picktranscargo/$username/$password";
        $response = Http::post($url, $data_request);
        return $response;
    }

    public static function rajaongkirProvince($id = null)
    {
        $url = env('RAJAONGKIR_API_URL');
        $key = env('RAJAONGKIR_API_KEY');
        $response = Http::withHeaders([
            'key' => $key
            ])->asForm()->get($url.'/province?id='.$id);
        return $response;
    }

    public static function rajaongkirCity($province, $id = null)
    {
        $url = env('RAJAONGKIR_API_URL');
        $key = env('RAJAONGKIR_API_KEY');
        $response = Http::withHeaders([
            'key' => $key
            ])->asForm()->get($url.'/city?province='.$province.'&id='.$id);
        return $response;
    }

    public static function rajaongkirCost(Request $request)
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
        return $results;
    }
}
