<?php

namespace App\Http\Controllers\Index;

use App\Element;
use App\Http\Controllers\Controller;

class IndexstaticController extends Controller
{
    //
    public function index()
    {
        $element = (new Element())->getIndexEnsstial();
        $code = view('index', $element);
        file_put_contents('index.html', $code);
        return $code;
    }


    //欧美list
    public function oumeilist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('oumei', $id, 10);
        $code = view('movielist', $element);
        return $code;
        return view('movielist');
    }


    //大陆list
    public function dalulist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('dalu', $id, 10);
        $code = view('movielist', $element);
        return $code;
        return view('movielist');
    }

    //rihan list
    public function rihanlist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('rihan', $id, 10);
        $code = view('movielist', $element);
        return $code;
        return view('movielist');
    }


    //港台list
    public function gangtailist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('gangtai', $id, 10);
        $code = view('movielist', $element);
        return $code;
        return view('movielist');
    }

    //经典电影list
    public function jingdianlist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('jingdian', $id, 10);
        $code = view('movielist', $element);
        return $code;
        return view('movielist');
    }

    //
    public function movie($id)
    {
        if (!$id) {
            exit('请求异常');
        }
        //从头获取数据
        $element = (new Element())->getMovieEnsstial($id);
        $code = view('detail', $element);
        return $code;
        return view('detail');
    }

    //影评list
    public function yingpinglist($id = 1)
    {
        $element = (new Element())->getYingpingListEnsstial($id, 10);
        $code = view('reviewlist', $element);
        return $code;
        return view('reviewlist');
    }

    /**
     * 电影影评
     * @access public
     */
    public function review($id)
    {
        if (!$id) {
            exit('请求异常');
        }
        //从头获取数据
        $element = (new Element())->getReviewEnsstial($id);
        $code = view('reviewdetail', $element);
        return $code;
        return view('reviewdetail');
    }

    /**
     * 根据电影分类来展现电影
     *
     */
    public function typemovielist($id = 1, $page = 1)
    {
        //获取分类的id
        $element = (new Element())->getTypeMovieListEnsstial($id, $page, 10);
        $code = view('movielist', $element);
        return $code;
        return view('movielist');
    }


    /**
     * 根据电影标志来展现电影
     *
     */
    public function tagmovielist($id = 1, $page = 1)
    {
        //获取分类的id
        $element = (new Element())->getTagMovieListEnsstial($id, $page, 10);
        $code = view('movielist', $element);
        return $code;
        return view('movielist');
    }

}
