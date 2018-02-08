<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Base
{
    protected $table = 'company';

    protected $fillable = ['name'];

    public function users(){
        return $this->hasMany('App\User');
    }
}
