<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Btbtdymoviedownloadlink extends Model
{
    protected $table = 'movie_btbtdy_download_link';
    //不主动维护 时间戳字段
    public $timestamps = false;
}
