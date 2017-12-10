<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use App\Moviedownloadlink;
use Illuminate\Http\Request;

class MoviedownloadlistController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page');
        $row = $request->input('rows');
        list($skip, $take) = CommonController::getPageInfo($page, $row);
        $movie_name = $request->input('movie_name');
        $query = Moviedownloadlink::where('text', 'like', "%$movie_name%");
        $rows = $query->take($take)->skip($skip)->orderBy('id', 'desc')->get(['*']);
        //需要执行操作把 区域 电影类型展现出来
        $count = Moviedownloadlink::where('text', 'like', "%$movie_name%")->count();
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
        $input = $request->all();
        $model = Moviedownloadlink::create($input);
        if ($model) {
            return response()->json(['status' => 'success', 'msg' => '电影添加成功', 'data' => []]);
        }
        return response()->json(['status' => 'failed', 'msg' => '电影添加失败请重试', 'data' => ['']]);
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
//        $data = [];
//        $movie = Movie::where('id', $id)->first();
//        if ($movie) {
//            $data = $movie->toArray();
//            $data['type'] = array_values(array_filter(explode(',', $data['type'])));
//            $data['tags'] = array_values(array_filter(explode(',', $data['tags'])));
//            return response()->json(['status' => 'success', 'msg' => '电影获取成功', 'data' => $data]);
//        }
//        return response()->json(['status' => 'failed', 'msg' => '电影获取失败请重试', 'data' => ['']]);
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
//        $input = $request->all();
//        if (array_key_exists('tags', $input)) {
//            $tag = implode(',', $input['tags']);
//            $input['tags'] = $tag ? ",{$tag}," : '';
//        }
//        if (array_key_exists('type', $input)) {
//            $type = implode(',', $input['type']);
//            $input['type'] = $type ? ",{$type}," : '';
//        }
//        if (Movie::where('id', $id)->update($input)) {
//            return response()->json(['status' => 'success', 'msg' => '电影修改成功', 'data' => []]);
//        }
//        return response()->json(['status' => 'failed', 'msg' => '电影修改失败请重试', 'data' => ['']]);
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


    /**
     * 电影下载类型
     * @access public
     */
    public function downloadtype()
    {
        $data = [
            ['id' => 1, 'text' => '磁力下载'],
            ['id' => 2, 'text' => '电驴下载'],
            ['id' => 3, 'text' => '迅雷下载'],
            ['id' => 4, 'text' => '百度云'],
            ['id' => 10, 'text' => '其他'],
        ];
        return response()->json(['status' => 'success', 'data' => $data, 'msg' => 'get data success']);
    }

}
