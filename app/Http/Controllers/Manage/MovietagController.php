<?php

namespace App\Http\Controllers\Manage;

use App\Movietag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovietagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movietag $movietag
     * @return \Illuminate\Http\Response
     */
    public function show(Movietag $movietag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movietag $movietag
     * @return \Illuminate\Http\Response
     */
    public function edit(Movietag $movietag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Movietag $movietag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movietag $movietag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movietag $movietag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movietag $movietag)
    {
        //
    }

    /**
     * get 方式获取列表
     * @access public
     */
    public function getlist()
    {
        $list = Movietag::orderBy('id', 'ASC')->get(['id', 'name']);
        $data = [];
        foreach ($list as $v) {
            $data[] = ['value' => (string)$v->id, 'label' => $v->name];
        }
        return response()->json(['status' => 'success', 'data' => $data, 'msg' => 'get data success']);
    }
}
