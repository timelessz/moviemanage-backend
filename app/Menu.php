<?php

namespace App;


class Menu
{
    //该菜单用于展现 相关页面的 tdk
    /**
     * 公共的菜单列表  后期会动态调整的
     */
    public static function get_menu()
    {
        return [
            ['path' => '/index.html', 'text' => '首页', 'title' => ''],
            ['path' => '/oumei.html', 'text' => '欧美电影'],
            ['path' => '/dalu.html', 'text' => '大陆电影'],
            ['path' => '/rihan.html', 'text' => '日韩电影'],
            ['path' => '/gangtai.html', 'text' => '港台电影'],
            ['path' => '/recommend.html', 'text' => '博主推荐'],
            ['path' => '/yingping.html', 'text' => '电影影评'],
            ['path' => '/meiju.html', 'text' => '美剧下载'],
        ];
    }


}
