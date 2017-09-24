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
     *
     * @var array
     */
    protected $fillable = ['name', 'alias_name', 'title', 'coversrc',
        'type', 'length', 'imdbscore', 'imdburl', 'doubanscore', 'doubanurl',
        'region_id', 'region_name', 'director', 'ages', 'releasedate', 'starring',
        'comment', 'summary', 'content', 'tags', 'language'];
}

//create table movie_movie_list
//(
//	name varchar(200) null comment '电影名',
//	en_name varchar(200) default '' null comment '英文名',
//	title varchar(300) default '' null comment '标题',
//	cover_src varchar(500) null comment '缩略图的src',
//	type varchar(200) null comment '电影的分类',
//	duration varchar(50) null comment '电影时长',
//	douban_score varchar(20) default '0' null comment '豆瓣评分',
//	douban_url varchar(500) default '' null comment '豆瓣链接',
//	region int null comment '区域 欧美 日韩 大陆 港台 印度 其他',
//	director varchar(50) default '' null comment '导演',
//	ages varchar(20) default '' null comment '电影年代',
//	releasedate varchar(500) null comment '上映时间',
//	starring text null comment '演员',
//	comment text null comment '豆瓣之类的评分',
//	summary varchar(1000) null comment '电影简介',
//	content longtext null comment '内容',
//	tags varchar(500) default '' null comment '分类标签',
//	created_at int null,
//	updated_at int null,
//	constraint table_name_id_uindex
//		unique (id)
//)
//comment '最终的电影表'
//;

