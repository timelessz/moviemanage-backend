<?php

namespace App;


class Tdk
{

    private $main_keyword = [

    ];

    private $tdk_template = [
        //首页
        'index' => ['title' => '影窝电影-电影天堂_电影下载_免费电影_迅雷电影下载', 'keywords' => '影窝电影,免费电影下载,电影下载,最新电影,电影天堂', 'description' => '影窝是最好的迅雷电影下载网，分享最新电影，高清电影、综艺、动漫、电视剧等下载，同时为您提供相关电影影评。'],
        //电影列表
        'movielist' => ['title' => '', 'keywords' => '', 'description' => ''],
        //电影详情
        'movie' => ''
    ];

    //该模型用于生成页面的tdk 等信息 根据设置的关键词来
    public function get_tdk($current)
    {

    }

}
