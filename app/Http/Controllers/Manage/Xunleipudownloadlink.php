<?php

namespace App\Http\Controllers\Manage;

use App\Xunleipumoviedownloadlink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Xunleipudownloadlink extends Controller
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
     * @param  \App\XunleipuMoviedownloadlink $xunleipuMoviedownloadlink
     * @return \Illuminate\Http\Response
     */
    public function show(Xunleipumoviedownloadlink $xunleipumoviedownloadlink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\XunleipuMoviedownloadlink $xunleipuMoviedownloadlink
     * @return \Illuminate\Http\Response
     */
    public function edit(Xunleipumoviedownloadlink $xunleipumoviedownloadlink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\XunleipuMoviedownloadlink $xunleipuMoviedownloadlink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Xunleipumoviedownloadlink $xunleipumoviedownloadlink)
    {
        $data = $request->input();
        unset($data['_index']);
        unset($data['_rowKey']);
        $status = 'failed';
        $msg = '修改失败';
        if ($xunleipumoviedownloadlink->where('id', $data['id'])->update($data)) {
            $status = 'success';
            $msg = '修改成功';
        }
        return response()->json(['status' => $status, 'data' => [], 'msg' => $msg]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\XunleipuMoviedownloadlink $xunleipuMoviedownloadlink
     * @return \Illuminate\Http\Response
     */
    public function destroy(Xunleipumoviedownloadlink $xunleipumoviedownloadlink)
    {
        //删除下载链接
        $status = 'failed';
        $msg = '删除失败';
        if ($xunleipumoviedownloadlink->delete()) {
            $status = 'success';
            $msg = '删除成功';
        }
        return response()->json(['status' => $status, 'data' => [], 'msg' => $msg]);
    }
}
