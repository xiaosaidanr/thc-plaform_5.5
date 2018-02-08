<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $this->middleware('auth');
    }

    public function _index($where = null, $callback = null){
        $items = null;
        if ($where == null) {
            $where = [DB::raw('1'), 1];
        }
        $items = call_user_func_array([$static::$model, 'where'], $where);
        if (Request::has('sort')) {
            list($sortCol, $sortDir) = explode('|', Request::input('sort'));
            $items = $items->orderBy($sortCol, $sortDir);
        }
        else{
            $items = $items->orderBy('id', 'asc');
        }
        $with = Request::input('with');

        if ($with) {
            if (str_contains($with, ',')) {
                $with = explode(',', $with);
            }
            $items = $items->with($with);
        }
        if ($callback) {
            $callback($items);
        }
        return $items->get();
    }

    public function _show($id){
        $model = static::$model;
        $with = Request::input('with');
        if ($with) {
            if(str_contains($with, ',')){
                $with = explode(',', $with);
            }
            $model = call_user_func([$model, 'with'], $with);
        }
        return call_user_func([$model, 'find'], $id);
    }

    public function _update($id, $data){
        $model = call_user_func([static::$model, 'find'], $id);
        $model->fill($data);
        $model->save();
        return $model;
    }

    public function _destroy($id){
        $model = call_user_func([static::$model, 'find'], $id);
        if(is_null($model)) {
            return null;
        }
        $model->delete();
        return $model;
    }

    public function user(){
        return Auth::user();
    }
}
