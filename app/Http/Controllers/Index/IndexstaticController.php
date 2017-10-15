<?php

namespace App\Http\Controllers\Index;

use App\Element;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexstaticController extends Controller
{
    //
    public function index()
    {
        $element = (new Element())->getIndexEnsstial();
        $code = view('index');
        file_put_contents('index.html', $code);
    }


    //
    public function oumeilist($id = 1)
    {
        return view('list');
    }


    //
    public function dalulist($id = 1)
    {
        return view('list');
    }

    //
    public function rihanlist($id = 1)
    {
        return view('list');
    }


    //
    public function gangtailist($id = 1)
    {
        return view('list');
    }


    //
    public function detaildemo()
    {
        return view('detail');
    }
}
