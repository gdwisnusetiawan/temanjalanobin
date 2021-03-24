<?php

namespace App;

use App\Helpers\Functions;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Payment extends Model
{
    protected $table = 'payment';
    public $timestamps = false;
    protected $connection = 'paymentgateway';

    protected function getConfigAttribute()
    {
        return Config::first();
    }

    // public $insurance_percent = 2;
    // public $tax_percent = 10;
    // public $admin_fee_percent = 3;

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
        return $this->belongsTo('App\Merchant', 'merchant_id', 'merchantid');
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
        return Functions::datetimeFormat($this->transactionexpire, 'F jS, Y H:i:s');
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
        $total = $this->transactionmount - $this->discount + $this->shipping_cost + $this->insurance + $this->tax;
        if($this->is_credit) {
            $total += $this->admin_fee;
        }
        return $total;
    }

    public function getBalanceAttribute()
    {
        return $this->grand_total - $this->paymentProofs->where('status', 2)->sum('transfer_amount');
    }

    public function getInsuranceAttribute()
    {
        return $this->shipping_cost * $this->config->insurance / 100;
    }
    
        public function getTaxAttribute()
        {
            return $this->transactionmount * $this->config->tax / 100;
        }

    public function getAdminFeeAttribute()
    {
        return $this->transactionmount * $this->config->admin_fee / 100;
    }

    public function getIsCreditAttribute()
    {
        if(isset($this->merchant)) {
            return Str::contains($this->merchant->name, ['credit', 'kredit']) ? true : false;
        }
        else {
            return false;
        }
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

    public function getInsuranceFormatAttribute()
    {
        return Functions::formatCurrency($this->insurance);
    }
    
        public function getTaxFormatAttribute()
        {
            return Functions::formatCurrency($this->tax);
        }

    public function getAdminFeeFormatAttribute()
    {
        return Functions::formatCurrency($this->admin_fee);
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
        return $this->address .', '. ucwords($this->city_name) .', '. ucwords($this->province_name) .', '. $this->postcode;
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
}
