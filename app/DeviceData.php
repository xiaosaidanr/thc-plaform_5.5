<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceData extends Base
{
    protected $table = 'device_data';

    public function config(){
        return $this->belongsTo('App\DeviceConfig', 'device_config_id');
    }
}
