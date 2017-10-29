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
//        return $code;
        file_put_contents('index.html', $code);
    }


    //
    public function oumeilist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('oumei', $id, 10);
        $code = view('movielist', $element);
        return $code;
        return view('movielist');
    }


    //
    public function dalulist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('dalu', $id, 10);
        $code = view('movielist', $element);
        return $code;
        return view('movielist');
    }

    //
    public function rihanlist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('rihan', $id, 10);
        $code = view('movielist', $element);
        return $code;
        return view('movielist');
    }


    //
    public function gangtailist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('gangtai', $id, 10);
        $code = view('movielist', $element);
        return $code;
        return view('movielist');
    }

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

    /**
     * 根据电影分类来展现电影
     *
     */
    public function typemovielist($id = 1, $page = 1)
    {
        //获取分类的id
        $element = (new Element())->getTypeMovieListEnsstial( $id, $page, 10);
        $code = view('movielist', $element);
        return $code;

        return view('movielist');
    }


}
