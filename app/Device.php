<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Base
{
    protected $table = 'device';

    protected $fillable = ['company_id', 'name', 'type', 'model', 'sn',
    'version', 'iccid'];

    public function configs(){
        return $this->hasMany('App\DeviceConfig');
    }

    public function config(){
        return $this->configs()->orderBy('updated_at', 'desc')->limit(1);
    }
}
