<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //迅雷铺 list 字段
    protected $table = 'movie_movie_list';
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

    /**
     * 可以被批量赋值的属性。
     * @var array
     */
    protected $fillable = ['name', 'alias_name', 'title', 'coversrc', 'type', 'length', 'imdbscore', 'imdburl', 'doubanscore', 'doubanurl', 'region_id', 'region_name', 'director', 'ages', 'releasedate', 'starring',
        'comment', 'summary', 'content', 'tags', 'language', 'comefrom', 'country', 'big_coversrc', 'bigcoversrc_settime', 'pvcount', 'is_show', 'is_hot', 'created_at', 'updated_at'];
}

