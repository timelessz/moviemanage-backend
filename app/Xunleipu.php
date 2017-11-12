<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Xunleipu extends Model
{
    //迅雷铺 list 字段
    protected $table = 'movie_xunleipu_list';
    //不主动维护 时间戳字段
    public $timestamps = false;
}
