<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use Bouncer;

class DeviceController extends Controller
{

    static $model = \App\Device::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->user()->devices;
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
    public function store(Request $request)
    {
        //
        if (Bouncer::can('create_device')) {
            $this->validate($request, [

            ]);
            $body = $request->all();
            $body['company_id'] = $this->user()->company_id;
            return Device::create($body);
        }
        else{
            abort(403, "Resource access denied");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = Device::find($id);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $device = Device::find($id);
        if(is_null($device)){
            abort(403, "Resource not found");
        }
        else{
            if (Bouncer::can('write', $device)) {
                $this->validate($request, [

                ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $device = Device::find($id);
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
