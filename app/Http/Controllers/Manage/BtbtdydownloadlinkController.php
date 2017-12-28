<?php

namespace App\Http\Controllers\Manage;

use App\Btbtdymoviedownloadlink;
use App\Hao6vmoviedownloadlink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BtbtdydownloadlinkController extends Controller
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->input();
        unset($data['_index']);
        unset($data['_rowKey']);
        $status = 'failed';
        $msg = '修改失败';
        if (Btbtdymoviedownloadlink::where('id', $data['id'])->update($data)) {
            $status = 'success';
            $msg = '修改成功';
        }
        return response()->json(['status' => $status, 'data' => Btbtdymoviedownloadlink::where('id', $data['id'])->first(), 'msg' => $msg]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除下载链接
        $status = 'failed';
        $msg = '删除失败';
        if (Hao6vmoviedownloadlink::where('id', $id)->delete()) {
            $status = 'success';
            $msg = '删除成功';
        }
        return response()->json(['status' => $status, 'data' => [], 'msg' => $msg]);
    }
}
