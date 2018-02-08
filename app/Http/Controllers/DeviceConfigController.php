<?php

namespace App\Http\Controllers;

use App\DeviceConfig;
use Illuminate\Http\Request;
use App\Device;
use Bouncer;

class DeviceConfigController extends Controller
{
    static $model = \App\DeviceConfig::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($device_id)
    {
        $device = Device::find($device_id);
        if(is_null($device)){
            abort(403, "Resource not found");
        }
        else{
            if (Bouncer::can('read', $device)) {
                return $this->_index(['device_id', '=', $device_id]);
            }
            else{
                abort(403, "Resource access denied");
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $device_id)
    {
        $device = Device::find($device_id);
        if(is_null($device)){
            abort(403, "Resource not found");
        }
        else{
            if (Bouncer::can('write', $device)) {
                $this->validate($request, [
                    'data' => 'required',
                    'control' => 'required',
                ]);
                $body = $request->all();
                $body['device_id'] = $device_id;
                return $this->_store($body);
            }
            else{
                abort(403, "Resource access denied");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeviceConfig  $deviceConfig
     * @return \Illuminate\Http\Response
     */
    public function show($device_id, $id)
    {
        //
        $device = Device::find($device_id);
        if(is_null($device)){
            abort(403, "Resource not found");
        }
        else{
            if (Bouncer::can('read', $device)) {
                return $this->_show($id);
            }
            else{
                abort(403, "Resource access denied");
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeviceConfig  $deviceConfig
     * @return \Illuminate\Http\Response
     */
    public function edit(DeviceConfig $deviceConfig)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeviceConfig  $deviceConfig
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $device_id, $id)
    {
        //
        $device = Device::find($device_id);
        if(is_null($device)){
            abort(403, "Resource not found");
        }
        else{
            if (Bouncer::can('write', $device)) {
                $this->validate($request, []);
                return $this->_update($id, $request->all());
            }
            else{
                abort(403, "Resource access denied");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeviceConfig  $deviceConfig
     * @return \Illuminate\Http\Response
     */
    public function destroy($device_id, $id)
    {
        //
        $device = Device::find($device_id);
        if(is_null($device)){
            abort(403, "Resource not found");
        }
        else{
            if (Bouncer::can('write', $device)) {
                $this->validate($request, [

                ]);
                return $this->_destroy($id);
            }
            else{
                abort(403, "Resource access denied");
            }
        }
    }
}
