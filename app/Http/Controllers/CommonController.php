<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    //该控制器主要编写一些公共的方法

    /**
     * 获取分页 take 条数
     */
    public static function getPageInfo($page, $rows)
    {
        if (intval($page) < 1) {
            $page = 1;
        }
        if (intval($rows) < 1) {
            $rows = 10;
        }
        $skip = ($page - 1) * $rows;
        return [$skip, $rows];
    }

}
