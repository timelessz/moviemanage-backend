<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\CommonController;
use App\Moviereview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MoviereviewController extends Controller
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
        $query = Moviereview::where('movie_name', 'like', "%$movie_name%")->orWhere('title', 'like', "%$movie_name%");
        $rows = $query->take($take)->skip($skip)->orderBy('id', 'desc')->get(['id', 'movie_name', 'thumbnail','type', 'summary', 'title', 'created_at']);
        //需要执行操作把 区域 电影类型展现出来
        $count = Moviereview::where('movie_name', 'like', "%$movie_name%")->orWhere('title', 'like', "%$movie_name%")->count();
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
        $input = $request->all();
        $model = Moviereview::create($input);
        if ($model) {
            return response()->json(['status' => 'success', 'msg' => '影评添加成功', 'data' => []]);
        }
        return response()->json(['status' => 'failed', 'msg' => '影评添加失败请重试', 'data' => ['']]);

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
        $data = [];
        $moviereview = Moviereview::where('id', $id)->first();
        if ($moviereview) {
            $data = $moviereview->toArray();
            return response()->json(['status' => 'success', 'msg' => '影评获取成功', 'data' => $data]);
        }
        return response()->json(['status' => 'failed', 'msg' => '影评获取失败请重试', 'data' => ['']]);
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
        //执行修改相关操作
        $input = $request->all();
        if (Moviereview::where('id', $id)->update($input)) {
            return response()->json(['status' => 'success', 'msg' => '影评修改成功', 'data' => []]);
        }
        return response()->json(['status' => 'failed', 'msg' => '影评修改失败请重试', 'data' => ['']]);
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
