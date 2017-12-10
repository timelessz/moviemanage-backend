<?php

namespace App\Http\Controllers\Manage;

use App\Hao6v;
use App\Hao6vmoviedownloadlink;
use App\Hao6vmovieimglist;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Hao6vController extends Controller
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
        $query = Hao6v::Where('title', 'like', "%$movie_name%");
        $countquery = Hao6v::Where('title', 'like', "%$movie_name%");
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
        $hao6v = Hao6v::where('id', $id)->first();
        $hao6v->type = array_values(array_filter(explode(',', $hao6v->type)));
        $movie_id = $id;
        unset($hao6v->filesize);
        unset($hao6v->screensize);
        unset($hao6v->filetype);
        unset($hao6v->update_time);
        unset($hao6v->subtitle);
        unset($hao6v->create_time);
        $hao6v->content;
        $hao6v->content = trim(str_replace('◎', '<br>', strip_tags($hao6v->content)));
        $hao6v->content = str_replace("rn", '', stripslashes($hao6v->content));
        $img_list = Hao6vmovieimglist::where('movie_id', $movie_id)->get(['imgsrc'])
            ->toArray();
        $img_str = '';
        foreach ($img_list as $v) {
            $img_str = "<img src='{$v['imgsrc']}' title='{$hao6v->title}' alt='{$hao6v->title}'><br>" . $img_str;
        }
        $hao6v->content = $img_str . $hao6v->content;
        //处理相关的下载字段
        $download_link = Hao6vmoviedownloadlink::where('movie_id', $movie_id)->get(['id', 'movie_id', 'type_id', 'type_name', 'href', 'text', 'pwd'])
            ->toArray();
        return Response()->json(['status' => 'success', 'msg' => '获取数据成功', 'data' => ['movie' => $hao6v, 'downloadlink' => $download_link]]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
