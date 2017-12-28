<?php

namespace App\Http\Controllers\Manage;

use App\Btbtdy;
use App\Btbtdymoviedownloadlink;
use App\Hao6vmoviedownloadlink;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BtbtdyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page');
        $row = $request->input('rows');
        list($skip, $take) = CommonController::getPageInfo($page, $row);
        $movie_name = $request->input('movie_name');
        $region_id = $request->input('region_id');
        $ages = $request->input('ages');
        $query = Btbtdy::Where('title', 'like', "%$movie_name%");
        $countquery = Btbtdy::Where('title', 'like', "%$movie_name%");
        if ($region_id) {
            $query->where('region_id', $region_id);
            $countquery->where('region_id', $region_id);
        }
        if ($ages) {
            $query->where('ages', 'like', $ages);
            $countquery->where('ages', 'like', $ages);
        }
        $rows = $query->take($take)->skip($skip)->orderBy('id', 'desc')->get(['id', 'name', 'alias_name', 'title', 'ages', 'type', 'coversrc', 'region_name', 'href', 'movie_id', 'create_time']);
        $count = $countquery->count();
        return response()->json(['status' => 'success', 'data' => ['rows' => $rows, 'total' => $count], 'msg' => 'get data success']);
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
        $btbtdy = Btbtdy::where('id', $id)->first();
        $btbtdy->type = array_values(array_filter(explode(',', $btbtdy->type)));
        $movie_id = $id;
        unset($btbtdy->filesize);
        unset($btbtdy->screensize);
        unset($btbtdy->filetype);
        unset($btbtdy->update_time);
        unset($btbtdy->subtitle);
        unset($btbtdy->create_time);
        //处理相关的下载字段
        $download_link = Btbtdymoviedownloadlink::where('movie_id', $movie_id)->get(['id', 'movie_id', 'type_id', 'type_name', 'href', 'text', 'pwd'])
            ->toArray();
        return Response()->json(['status' => 'success', 'msg' => '获取数据成功', 'data' => ['movie' => $btbtdy, 'downloadlink' => $download_link]]);
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
         }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


    }
}
