<?php

namespace App\Http\Controllers\Manage;

use App\Dytt;
use App\Dyttmoviedownloadlink;
use App\Dyttmovieimglist;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DyttController extends Controller
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
        $query = Dytt::Where('title', 'like', "%$movie_name%");
        $countquery = Dytt::Where('title', 'like', "%$movie_name%");
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
        $dytt = Dytt::where('id', $id)->first();

        $dytt->type = array_values(array_filter(explode(',', $dytt->type)));
        $movie_id = $dytt->id;
        unset($dytt->filesize);
        unset($dytt->screensize);
        unset($dytt->filetype);
        unset($dytt->update_time);
        unset($dytt->subtitle);
        unset($dytt->create_time);
        $dytt->content;
        $dytt->content = trim(str_replace('◎', '<br>', strip_tags($dytt->content)));
        $dytt->content = str_replace("rn", '', stripslashes($dytt->content));
        $img_list = Dyttmovieimglist::where('movie_id', $movie_id)->get(['imgsrc'])
            ->toArray();
        $img_str = '';
        foreach ($img_list as $v) {
            $img_str = "<img src='{$v['imgsrc']}' title='{$dytt->title}' alt='{$dytt->title}'><br>".$img_str;
        }
        $dytt->content = $img_str . $dytt->content;
        //处理相关的下载字段
        $download_link = Dyttmoviedownloadlink::where('movie_id', $movie_id)->get(['id','type_id', 'type_name', 'href', 'text', 'pwd'])
            ->toArray();
        return Response()->json(['status' => 'success', 'msg' => '获取数据成功', 'data' => ['movie' => $dytt, 'downloadlink' => $download_link]]);
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
