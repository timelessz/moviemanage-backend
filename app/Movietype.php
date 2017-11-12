<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Movietype extends Model
{
    //迅雷铺 list 字段
    protected $table = 'movie_type';

    /**
     * 获取电影的分类跟name
     * @access public
     */
    public function getMovieTypeIdName()
    {
        $data = Cache::get('movietype', function () {
            $type = $this->get(['id', 'name']);
            $data = [];
            foreach ($type as $k => $v) {
                $data[$v['id']] = $v['name'];
            }
            return $data;
        });
        return $data;
    }

}
