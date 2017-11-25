<?php
/**
 * Created by PhpStorm.
 * 电影页面相关的静态化
 * User: timeless
 * Date: 17-11-22
 * Time: 下午10:02
 */

namespace App\Http\Controllers\Index;


use App\Element;
use App\Movie;
use Illuminate\Support\Facades\Cache;

class MoviestaticController
{
    /**
     * 电影静态化
     */
    public function index()
    {
        //手动请求首先全部清除缓存
        Cache::flush();
        $count = Movie::where('is_static', '10')->count();
        $step = 10;
        $step_count = ceil($count / $step);
        $static_ids = [];
        for ($i = 1; $i <= $step_count; $i++) {
            $skip = ($i - 1) * 10;
            $movielist = Movie::where('is_static', '10')->skip($skip)->limit($step)->get(['*'])->toArray();
            foreach ($movielist as $movie) {
                $element = (new Element())->getMovieCompact($movie);
                $code = view('detail', $element);
                file_put_contents("movie/movie{$movie['id']}.html", $code);
                //
                $static_ids[] = $movie['id'];
            }
        }
        //批量更新静态化的状态
        foreach ($static_ids as $id) {
            Movie::where('id', $id)->update(['is_static' => '20']);
        }
    }
}