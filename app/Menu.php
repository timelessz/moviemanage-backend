<?php

namespace App;


class Menu
{
    //该菜单用于展现 相关页面的 tdk
    /**
     * 公共的菜单列表  后期会动态调整的
     */
    public function get_menu($current = '')
    {
        $menu = [
            ['en' => 'index', 'path' => '/index.html', 'text' => '首页', 'title' => '影窝首页', 'priority' => '1.0'],
            ['en' => 'oumei', 'path' => '/oumei.html', 'text' => '欧美电影', 'title' => '欧美电影，影窝', 'priority' => '0.7'],
            ['en' => 'dalu', 'path' => '/dalu.html', 'text' => '大陆电影', 'title' => '欧美电影，影窝', 'priority' => '0.7'],
            ['en' => 'rihan', 'path' => '/rihan.html', 'text' => '日韩电影', 'title' => '日韩电影，影窝', 'priority' => '0.7'],
            ['en' => 'gangtai', 'path' => '/gangtai.html', 'text' => '港台电影', 'title' => '港台电影，影窝', 'priority' => '0.7'],
            ['en' => 'jingdian', 'path' => '/jingdian.html', 'text' => '经典电影', 'title' => '经典电影，影窝', 'priority' => '0.7'],
            ['en' => 'recommend', 'path' => '/recommend.html', 'text' => '博主推荐', 'title' => '电影评论，影窝', 'priority' => '0.7'],
            ['en' => 'yingping', 'path' => '/yingping.html', 'text' => '电影影评', 'title' => '电影影评，影窝', 'priority' => '0.7'],
            ['en' => 'meiju', 'path' => '/meiju.html', 'text' => '美剧下载', 'title' => '美剧下载，影窝', 'priority' => '0.7'],
            ['en' => 'type', 'path' => '/typelist.html', 'text' => '电影分类', 'title' => '电影分类，影窝', 'priority' => '0.5'],
            ['en' => 'tag', 'path' => '/taglist.html', 'text' => '电影标签', 'title' => '电影标签，影窝', 'priority' => '0.5'],
        ];
        //默认选中
        if ($current) {
            array_walk($menu, [$this, 'form_current'], $current);
        }
        return $menu;
    }


    private static function form_current(&$v, $k, $current)
    {
        if ($v['en'] == $current) {
            $v['current'] = '10';
        }
    }

}
