<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hao6v extends Model
{
    protected $table = 'movie_hao6v_list';
    //不主动维护 时间戳字段
    public $timestamps = false;
}
