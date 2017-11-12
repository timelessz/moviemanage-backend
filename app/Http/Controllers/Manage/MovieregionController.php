<?php

namespace App\Http\Controllers\Manage;

use App\Movieregion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovieregionController extends Controller
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
     * @param  \App\Movieregion $movieregion
     * @return \Illuminate\Http\Response
     */
    public function show(Movieregion $movieregion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movieregion $movieregion
     * @return \Illuminate\Http\Response
     */
    public function edit(Movieregion $movieregion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Movieregion $movieregion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movieregion $movieregion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movieregion $movieregion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movieregion $movieregion)
    {
        //
    }

    /**
     * get 方式获取列表
     * @access public
     */
    public function getlist()
    {
        $list = Movieregion::orderBy('id', 'ASC')->get(['id', 'name']);
        $data = [];
        foreach ($list as $v) {
            $data[] = ['value' => (string)$v->id, 'label' => $v->name];
        }
        return response()->json(['status' => 'success', 'data' => $data, 'msg' => 'get data success']);
    }
}
