<?php

namespace App;

use App\Helpers\Functions;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    public $timestamps = false;
    protected $connection = 'paymentgateway';

    public function getRouteKeyName()
    {
        return 'transactionno';
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function merchant()
    {
        return $this->belongsTo('App\Merchant', 'merchant_id', 'id');
    }

    public function paymentProofs()
    {
        return $this->hasMany('App\PaymentProof');
    }

    // public function order()
    // {
    //     return $this->belongsTo('App\Order', 'transactionno', 'invoiceno');
    // }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function getDateFormatAttribute()
    {
        return Functions::datetimeFormat($this->transactiondate);
    }

    public function getExpireFormatAttribute()
    {
        return Functions::datetimeFormat($this->transactionexpire);
    }

    public function getInvoiceDateFormatAttribute()
    {
        return Functions::datetimeFormat($this->invoicedate);
    }

    public function getInvoiceDuedateFormatAttribute()
    {
        return Functions::datetimeFormat($this->invoiceduedate);
    }

    public function getGrandTotalAttribute()
    {
        $shipping_cost = $this->shipping_cost;
        if(Config::first()->shipmentDisabled()) {
            $shipping_cost = 0;
        }
        return $this->transactionmount - $this->discount + $shipping_cost;
    }

    public function getBalanceAttribute()
    {
        return $this->grand_total - $this->paymentProofs->where('status', 2)->sum('transfer_amount');
    }

    public function getShippingCostFormatAttribute()
    {
        return Functions::formatCurrency($this->shipping_cost);
    }

    public function getDiscountFormatAttribute()
    {
        return Functions::formatCurrency($this->discount);
    }

    public function getSubtotalFormatAttribute()
    {
        return Functions::formatCurrency($this->transactionmount);
    }

    public function getTotalFormatAttribute()
    {
        return Functions::formatCurrency($this->grand_total);
    }

    public function getBalanceFormatAttribute()
    {
        return Functions::formatCurrency($this->balance);
    }

    public function getStatusDescAttribute()
    {
        if($this->status == 1) {
            $desc = ['text' => 'pending', 'color' => 'warning'];
        }
        elseif($this->status == 2) {
            $desc = ['text' => 'waiting', 'color' => 'info'];
        }
        elseif($this->status == 3) {
            $desc = ['text' => 'paid', 'color' => 'success'];
        }
        elseif($this->status == 4) {
            $desc = ['text' => 'canceled', 'color' => 'danger'];
        }
        elseif($this->status == 5) {
            $desc = ['text' => 'expired', 'color' => 'danger'];
        }
        else {
            $desc = ['text' => 'pending', 'color' => 'info'];
        }
        return $desc;
    }

    public function getAddressLineAttribute()
    {
        if($this->national()) {
            return $this->address .', '. ucwords($this->city_name) .', '. ucwords($this->province_name) .', '. $this->postcode;
        }
        else {
            return $this->address .', '. ucwords($this->country_name);
        }
    }

    public function getProvinceNameAttribute()
    {
        $response = Http::withHeaders([
            'content-type' => 'application/x-www-form-urlencoded',
            'key' => 'a668420368d4731d3ca94321058bcea2'
            ])->get('https://api.rajaongkir.com/starter/province?id='.$this->province);
        $result = json_decode($response->body())->rajaongkir->results;
        $province = '';
        if(!is_array($result)) {
            $province = $result->province;
        }
        return $province;
    }

    public function getCityNameAttribute()
    {
        $response = Http::withHeaders([
            'content-type' => 'application/x-www-form-urlencoded',
            'key' => 'a668420368d4731d3ca94321058bcea2'
            ])->get('https://api.rajaongkir.com/starter/city?id='.$this->city);
        $result = json_decode($response->body())->rajaongkir->results;
        $city = '';
        if(!is_array($result)) {
            $city = $result->city_name;
        }
        return $city;
    }

    public function getCountryNameAttribute()
    {
        $response = Http::withHeaders([
            'content-type' => 'application/x-www-form-urlencoded',
            'key' => 'a668420368d4731d3ca94321058bcea2'
            ])->get('https://pro.rajaongkir.com/api/v2/internationalDestination?id='.$this->country);
        $result = json_decode($response->body())->rajaongkir->results;
        $country = '';
        if(!is_array($result)) {
            $country = $result->country_name;
        }
        return $country;
    }

    public function getDestinationAttribute()
    {
        return $this->national() ? $this->city : $this->country;
    }

    public function national()
    {
        return !Config::first()->poslnr || ($this->country == null || $this->country == 0);
    }
}
