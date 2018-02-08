<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Base extends Model
{
    use SoftDeletes;

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->hidden[] = 'deleted_at';
    }
}
