<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\CommonController;
use App\Xunleipu;
use App\Xunleipumoviedownloadlink;
use App\Xunleipumovieimglist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $region_id = $request->input('region_id');
        $ages = $request->input('ages');
        $query = Xunleipu::Where('title', 'like', "%$movie_name%");
        $countquery = Xunleipu::Where('title', 'like', "%$movie_name%");
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
     * @param  \App\Xunleipu $xunleipu
     * @return \Illuminate\Http\Response
     */
    public function show(Xunleipu $xunleipu)
    {
        $xunleipu->type = array_values(array_filter(explode(',', $xunleipu->type)));
        $movie_id = $xunleipu->id;
        unset($xunleipu->filesize);
        unset($xunleipu->screensize);
        unset($xunleipu->filetype);
        unset($xunleipu->update_time);
        unset($xunleipu->subtitle);
        unset($xunleipu->create_time);
        $xunleipu->content;
        $xunleipu->content = trim(str_replace('◎', '<br>', strip_tags($xunleipu->content)));
        $xunleipu->content = str_replace("rn", '', stripslashes($xunleipu->content));
        $img_list = Xunleipumovieimglist::where('movie_id', $movie_id)->get(['imgsrc'])
            ->toArray();
        $img_str = '';
        foreach ($img_list as $v) {
            $img_str = "<img src='{$v['imgsrc']}' title='{$xunleipu->title}' alt='{$xunleipu->title}'><br>".$img_str;
        }
        $xunleipu->content = $img_str . $xunleipu->content;
        //处理相关的下载字段
        $download_link = Xunleipumoviedownloadlink::where('movie_id', $movie_id)->get(['id','type_id', 'type_name', 'href', 'text', 'pwd'])
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
