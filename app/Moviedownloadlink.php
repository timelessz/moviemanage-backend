<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moviedownloadlink extends Model
{
    //电影的下载链接
    protected $table = 'movie_download_link';
    //不主动维护 时间戳字段
    public $timestamps = false;

    //存储时间戳
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_at = time();
            $model->updated_at = time();
            return true;
        });
        static::updating(function ($model) {
            $model->updated_at = time();
            return true;
        });
        static::deleting(function ($model) {

        });
    }

    protected $fillable = ['movie_id', 'movie_name', 'comefrom', 'pre_movie_id', 'type_name', 'type_id', 'href', 'text', 'pwd', 'created_at', 'updated_at'];


}
