<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\CommonController;
use App\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovielistController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     * @todo 需要把电影的region type tag 展现出来
     */
    public function index(Request $request)
    {
        $page = $request->input('page');
        $row = $request->input('rows');
        list($skip, $take) = CommonController::getPageInfo($page, $row);
        $movie_name = $request->input('movie_name');
        $query = Movie::where('name', 'like', "%$movie_name%")->orWhere('alias_name', 'like', "%$movie_name%")->orWhere('title', 'like', "%$movie_name%");
        $rows = $query->take($take)->skip($skip)->orderBy('id', 'desc')->get(['id', 'name', 'alias_name', 'title', 'ages', 'type', 'coversrc', 'region_name', 'created_at']);
        //需要执行操作把 区域 电影类型展现出来
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
        $input = $request->all();
        if (array_key_exists('tags', $input)) {
            $tag = implode(',', $input['tags']);
            $input['tags'] = $tag ? ",{$tag}," : '';
        }
        if (array_key_exists('type', $input)) {
            $type = implode(',', $input['type']);
            $input['type'] = $type ? ",{$type}," : '';
        }
        $model = Movie::create($input);
        if ($model) {
            return response()->json(['status' => 'success', 'msg' => '电影添加成功', 'data' => []]);
        }
        return response()->json(['status' => 'failed', 'msg' => '电影添加失败请重试', 'data' => ['']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }

    /**
     * 迅雷铺电影转移到最终的电影库中
     * @access public
     */
    public function xunleipumovieadd(Request $request)
    {
        $input = $request->all();
        if (array_key_exists('tags', $input)) {
            $tag = implode(',', $input['tags']);
            $input['tags'] = $tag ? ",{$tag}," : '';
        }
        if (array_key_exists('type', $input)) {
            $type = implode(',', $input['type']);
            $input['type'] = $type ? ",{$type}," : '';
        }
        $model = Movie::create($input);
        if ($model) {
            $movie_id = $model->id;
            $pre_movieid = $request->id;

            //这个需要同步把 其他的数据转移过来
            return response()->json(['status' => 'success', 'msg' => '电影添加成功', 'data' => []]);
        }
        return response()->json(['status' => 'failed', 'msg' => '电影添加失败请重试', 'data' => ['']]);

    }

}
