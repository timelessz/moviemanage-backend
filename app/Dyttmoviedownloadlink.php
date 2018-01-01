<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dyttmoviedownloadlink extends Model
{
    //
    //迅雷铺 list 字段
    protected $table = 'movie_dytt_download_link';
    //不主动维护 时间戳字段
    public $timestamps = false;
}
