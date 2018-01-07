<?php

namespace App\Http\Controllers\Manage;

use App\Btbtdy;
use App\Btbtdymoviedownloadlink;
use App\Dyttmovieimglist;
use App\Hao6v;
use App\Hao6vmoviedownloadlink;
use App\Hao6vmovieimglist;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Index\IndexstaticController;
use App\Movie;
use App\Moviedownloadlink;
use App\Xunleipu;
use App\Xunleipumoviedownloadlink;
use App\Xunleipumovieimglist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MovielistController extends Controller
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
        $query = Movie::where('name', 'like', "%$movie_name%")->orWhere('alias_name', 'like', "%$movie_name%")->orWhere('title', 'like', "%$movie_name%");
        $rows = $query->take($take)->skip($skip)->orderBy('id', 'desc')->get(['id', 'title', 'ages', 'type', 'coversrc', 'region_name', 'comefrom', 'is_hot', 'is_show', 'big_coversrc', 'pvcount', 'country', 'created_at']);
        //需要执行操作把 区域 电影类型展现出来
        $count = Movie::where('name', 'like', "%$movie_name%")->orWhere('alias_name', 'like', "%$movie_name%")->orWhere('title', 'like', "%$movie_name%")->count();
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
     * 新添加资源
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     * 修改资源
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movie::where('id', $id)->first();
        if ($movie) {
            $data = $movie->toArray();
            $data['type'] = array_values(array_filter(explode(',', $data['type'])));
            $data['tags'] = array_values(array_filter(explode(',', $data['tags'])));
            //获取下载链接
            //处理相关的下载字段
            $download_link = Moviedownloadlink::where('movie_id', $id)->get(['id', 'movie_id', 'type_id', 'type_name', 'href', 'text', 'pwd']);
            if ($download_link) {
                $download_link = $download_link->toArray();
            }
            return response()->json(['status' => 'success', 'msg' => '电影获取成功', 'data' => ['movie' => $data, 'downloadlink' => $download_link]]);
        }
        return response()->json(['status' => 'failed', 'msg' => '电影获取失败请重试', 'data' => ['']]);
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
        $input = $request->all();
        if (array_key_exists('tags', $input)) {
            $tag = implode(',', $input['tags']);
            $input['tags'] = $tag ? ",{$tag}," : '';
        }
        if (array_key_exists('type', $input)) {
            $type = implode(',', $input['type']);
            $input['type'] = $type ? ",{$type}," : '';
        }
        if (Movie::where('id', $id)->update($input)) {
            //需要同步删除掉制定的电影
            $msg = '删除电影失败';
            if ($this->deleteMovie($id)) {
                $msg = '删除电影文件成功';
                (new IndexstaticController())->movie($id, 'restatic');
            }
            return response()->json(['status' => 'success', 'msg' => '电影修改成功 ' . $msg, 'data' => []]);
        }
        return response()->json(['status' => 'failed', 'msg' => '电影修改失败请重试', 'data' => ['']]);
    }


    /**
     * 删除制定一个电影文件
     * @param $id
     */
    public function deleteMovie($id)
    {
        $moviefile = sprintf('movie/movie%s.html', $id);
        if (file_exists($moviefile)) {
            if (unlink($moviefile)) {
                return true;
            }
        }
        return false;
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
     * 迅雷铺电影转移到最终的电影库中
     * @access public
     */
    public function xunleipumovieadd(Request $request)
    {
        $input = $request->all();
        if (!$input['region_id'] || !$input['region_name']) {
            return response()->json(['status' => 'failed', 'msg' => '请选择电影区域', 'data' => ['']]);
        }
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
            $movie_name = $model->name;
            $pre_movieid = $request->id;
            // 需要把 xunleipu 数据库中的下载链接存进来
            //还需要把内容中的图片存下来
            $download_data = Xunleipumoviedownloadlink::where('movie_id', $pre_movieid)->get()->toArray();
            $img_data = Xunleipumovieimglist::where('movie_id', $pre_movieid)->get()->toArray();
            $comefrom = 'xunleipu';
            array_walk($download_data, array($this, 'form_movieoption'), [$movie_id, $movie_name, $comefrom]);
            array_walk($img_data, array($this, 'form_movieoption'), [$movie_id, $movie_name, $comefrom]);
            DB::table('movie_download_link')->insert($download_data);
            DB::table('movie_imglist')->insert($img_data);
            //同时需要把 之前的电影中存下最终的电影id
            Xunleipu::where('id', $pre_movieid)->update(['movie_id' => $movie_id]);
            //这个需要同步把 其他的数据转移过来
            return response()->json(['status' => 'success', 'msg' => '电影添加成功', 'data' => []]);
        }
        return response()->json(['status' => 'failed', 'msg' => '电影添加失败请重试', 'data' => ['']]);
    }


    /**
     * 迅雷铺电影转移到最终的电影库中
     * @access public
     */
    public function hao6vmovieadd(Request $request)
    {
        $input = $request->all();
        if (!$input['region_id'] || !$input['region_name']) {
            return response()->json(['status' => 'failed', 'msg' => '请选择电影区域', 'data' => ['']]);
        }
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
            $movie_name = $model->name;
            $pre_movieid = $request->id;
            // 需要把 xunleipu 数据库中的下载链接存进来
            //还需要把内容中的图片存下来
            $download_data = Hao6vmoviedownloadlink::where('movie_id', $pre_movieid)->get()->toArray();
            $img_data = Hao6vmovieimglist::where('movie_id', $pre_movieid)->get()->toArray();
            $comefrom = 'hao6v';
            array_walk($download_data, array($this, 'form_movieoption'), [$movie_id, $movie_name, $comefrom]);
            array_walk($img_data, array($this, 'form_movieoption'), [$movie_id, $movie_name, $comefrom]);
            DB::table('movie_download_link')->insert($download_data);
            DB::table('movie_imglist')->insert($img_data);
            //同时需要把 之前的电影中存下最终的电影id
            Hao6v::where('id', $pre_movieid)->update(['movie_id' => $movie_id]);
            //这个需要同步把 其他的数据转移过来
            return response()->json(['status' => 'success', 'msg' => '电影添加成功', 'data' => []]);
        }
        return response()->json(['status' => 'failed', 'msg' => '电影添加失败请重试', 'data' => ['']]);
    }

    /**
     * 添加btbtdy 网站的相关链接
     * @access public
     */
    public function btbtdymovieadd(Request $request)
    {
        $input = $request->all();
        if (!$input['region_id'] || !$input['region_name']) {
            return response()->json(['status' => 'failed', 'msg' => '请选择电影区域', 'data' => ['']]);
        }
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
            $movie_name = $model->name;
            $pre_movieid = $request->id;
            // 需要把 xunleipu 数据库中的下载链接存进来
            //还需要把内容中的图片存下来
            $download_data = Btbtdymoviedownloadlink::where('movie_id', $pre_movieid)->get()->toArray();
            $comefrom = 'btbtdy';
            array_walk($download_data, array($this, 'form_movieoption'), [$movie_id, $movie_name, $comefrom]);
            DB::table('movie_download_link')->insert($download_data);
            //同时需要把 之前的电影中存下最终的电影id
            Btbtdy::where('id', $pre_movieid)->update(['movie_id' => $movie_id]);
            //这个需要同步把 其他的数据转移过来
            return response()->json(['status' => 'success', 'msg' => '电影添加成功', 'data' => []]);
        }
        return response()->json(['status' => 'failed', 'msg' => '电影添加失败请重试', 'data' => ['']]);
    }


    /**
     * 格式化
     */
    protected function form_movieoption(&$v, $k, $data)
    {
        list($movie_id, $movie_name, $comefrom) = $data;
        $v['pre_movie_id'] = $v['movie_id'];
        $v['movie_id'] = $movie_id;
        $v['movie_name'] = $movie_name;
        $v['comefrom'] = $comefrom;
        unset($v['create_time']);
        unset($v['update_time']);
        unset($v['id']);
        $v['created_at'] = time();
        $v['updated_at'] = time();
    }


    /**
     * 获取电影的bigMovieCoversrc
     * @access public
     */
    public function getMovieCoversrc($id)
    {
        $data = Movie::where('id', $id)->first(['big_coversrc']);
        if ($data) {
            $bigcoversrc = $data->toArray()['big_coversrc'];
            return response()->json(['status' => 'success', 'msg' => '获取轮播图成功', 'data' => ['bigcoversrc' => $bigcoversrc]]);
        }
        return response()->json(['status' => 'failed', 'msg' => '获取轮播图失败请重试', 'data' => []]);
    }

    /**
     * 获取电影的bigMovieCoversrc
     * @access public
     */
    public function getMovieImgset($id, $tag)
    {
        switch ($tag) {
            case 'xunleipu':
                $model = new Xunleipumovieimglist();
                break;
            case 'dytt':
                $model = new Dyttmovieimglist();
                break;
            case 'hao6v':
                $model = new Hao6vmovieimglist();
                break;
        }
        $data = $model->where('movie_id', '=', $id)->get(['imgsrc']);
        $img = [];
        foreach ($data as $v) {
            $img[] = $v['imgsrc'];
        }
        if ($img) {
            return response()->json(['status' => 'success', 'msg' => '获取轮播图成功', 'data' => $img]);
        }
        return response()->json(['status' => 'failed', 'msg' => '获取轮播图失败请重试', 'data' => []]);
    }


    /**
     * 保存设置好的 bigcoversrc
     * @access public
     */
    public function setMovieCoversrc(Request $request)
    {
        $data = $request->all();
        if (Movie::where('id', $data['id'])->update(['big_coversrc' => $data['coversrc'], 'bigcoversrc_settime' => time()])) {
            return response()->json(['status' => 'success', 'msg' => '修改首页大图成功', 'data' => []]);
        }
        return response()->json(['status' => 'failed', 'msg' => '修改首页大图失败请重试', 'data' => []]);
    }

    /**
     * 设置热门电影
     * @access public
     */
    public function setHotMovie($id)
    {
        if (Movie::where('id', $id)->update(['is_hot' => '20', 'hot_settime' => time()])) {
            return response()->json(['status' => 'success', 'msg' => '设置热门电影成功', 'data' => []]);
        }
        return response()->json(['status' => 'failed', 'msg' => '设置热门电影失败请重试', 'data' => []]);
    }

    /**
     * 获取博主推荐电影
     */
    public function getMovieRecommend($id)
    {
        $data = Movie::where('id', $id)->first(['recommend_reason']);
        if ($data) {
            return response()->json(['status' => 'success', 'msg' => '获取博主推荐电影成功', 'data' => ['recommend_reason' => $data->toArray()['recommend_reason']]]);
        }
        return response()->json(['status' => 'failed', 'msg' => '获取博主推荐电影失败请重试', 'data' => []]);
    }

    /**
     * 保存设置好的 推荐电影
     * @access public
     */
    public function setMovieRecommend(Request $request)
    {
        $data = $request->all();
        if (Movie::where('id', $data['id'])->update(['recommend_reason' => $data['recommend_reason'], 'recommend_settime' => time(), 'is_recommend' => '20'])) {
            return response()->json(['status' => 'success', 'msg' => '添加博主推荐成功', 'data' => []]);
        }
        return response()->json(['status' => 'failed', 'msg' => '添加博主推荐失败请重试', 'data' => []]);
    }

}
