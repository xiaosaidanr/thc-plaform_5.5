<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use Bouncer;

class DeviceDataController extends Controller
{

    static $model = \App\DeviceData::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($device_id, Request $request)
    {
        //
        $device = Device::find($device_id);
        if (is_null($device)) {
            abort(403, "Resource not found");
        }
        else{
            if (Bouncer::can('read', $device)) {
                $res = $this->_index(['device_id', '=', $device_id],
                    function (&$items) use ($request)
                    {
                        $items->orderBy('ts', 'asc')->with('config');
                        if ($request->input('start_at')) {
                            $items->where('ts', '>=', $request->input('start_at'));
                        }
                        if ($request->input('end_at')) {
                            $items->where('ts', '<=', $request->input('end_at'));
                        }
                    }
                );
                return $res;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }
}
