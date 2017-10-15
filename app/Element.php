<?php

namespace App;

class Element
{
    // 页面静态化的时候调用的必须的元素
    public function getIndexEnsstial()
    {
        $current = 'index';
        //菜单元素
        $menu = (new Menu())->get_menu($current);
        print_r($menu);
        //关键词元素
        $tdk = (new Tdk())->get_tdk($current);
    }


}
