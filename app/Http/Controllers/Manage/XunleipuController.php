<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\CommonController;
use App\Xunleipu;
use App\Xunleipumoviedownloadlink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class XunleipuController extends Controller
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
        $query = Xunleipu::where('name', 'like', "%$movie_name%")->orWhere('alias_name', 'like', "%$movie_name%")->orWhere('title', 'like', "%$movie_name%");
        $rows = $query->take($take)->skip($skip)->orderBy('id', 'desc')->get(['id', 'name', 'alias_name', 'title', 'ages', 'type', 'coversrc', 'region_name', 'href', 'create_time']);
        $count = $query->count();
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
     * @param  \App\Xunleipu $xunleipu
     * @return \Illuminate\Http\Response
     */
    public function show(Xunleipu $xunleipu)
    {
        $xunleipu->content = str_replace("rn", '', stripslashes($xunleipu->content));
        $xunleipu->type = array_values(array_filter(explode(',', $xunleipu->type)));
        $movie_id = $xunleipu->id;
        unset($xunleipu->filesize);
        unset($xunleipu->screensize);
        unset($xunleipu->filetype);
        unset($xunleipu->update_time);
        unset($xunleipu->subtitle);
        unset($xunleipu->create_time);
        $download_link = Xunleipumoviedownloadlink::where('movie_id', $movie_id)->get(['type_id', 'type_name', 'href', 'text', 'pwd'])
            ->toArray();
        return Response()->json(['status' => 'success', 'msg' => '获取数据成功', 'data' => ['movie' => $xunleipu, 'downloadlink' => $download_link]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Xunleipu $xunleipu
     * @return \Illuminate\Http\Response
     */
    public function edit(Xunleipu $xunleipu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Xunleipu $xunleipu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Xunleipu $xunleipu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Xunleipu $xunleipu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Xunleipu $xunleipu)
    {
        //
    }
}
