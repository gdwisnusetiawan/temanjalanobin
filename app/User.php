<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'master';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'password', 'ip', 'registerdate', 'accessdate', 'actorid', 'nohp', 'refbp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute()
    {
        return explode(' ', ($this->fullname))[0];
    }

    public function getAvatarAttribute()
    {
        if(Str::startsWith($this->avatarfile, 'http')) {
            return $this->avatarfile;
        }
        else {
            return is_file(public_path().'/img/'.$this->avatarfile) 
                ? asset('img/'.$this->avatarfile) 
                : 'https://ui-avatars.com/api/?name='.urlencode($this->fullname).'&color=7F9CF5&background=EBF4FF';
        }
    }

    public function getAddressLineAttribute()
    {
        return $this->address .', '. ucwords($this->city) .', '. ucwords($this->province) .', '. $this->postcode;
    }

    public function pricing($product_id)
    {
        return $this->hasMany('App\Pricing', 'actorid', 'actorid')->where('productid', $product_id)->get();
    }

    public function orders()
    {
        return $this->hasMany('App\Order', 'uid', 'id');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}
