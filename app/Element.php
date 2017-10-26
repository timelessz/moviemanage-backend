<?php

namespace App;

class Element
{

    //带图片的需要展现的字段列表
    private $pic_field = ['id', 'name', 'title', 'ages', 'summary', 'coversrc', 'type', 'doubanscore', 'region_id', 'region_name', 'director', 'created_at', 'country'];
    private $movietype = [];
    private $tag_path = '/tag/%s.html';
    private $type_path = '/type/%s.html';
    private $breadcrumb = [
        [
            'text' => '首页',
            'href' => '/index.html',
            'title' => '影窝电影网首页',
        ]
    ];

    /**
     * Element constructor.
     */
    public function __construct()
    {
        $this->movietype = (new Movietype())->getMovieTypeIdName();
    }


    /**
     * 页面静态化的时候调用的必须的元素
     * 获取首页必须的元素
     */
    public function getIndexEnsstial()
    {
        $current = 'index';
        $form_movie_arr = [$this, 'execFormatMovie'];
        //菜单元素
        $menu = (new Menu())->get_menu($current);
        //关键词元素
        $tdk_html = (new Tdk())->get_tdk($current);
        //print_r($tdk);
        //获取首页的最新 有轮播图的页面
        $fivecover_movie = Movie::where('bigcoversrc_settime', '!=', '0')->orderBy('bigcoversrc_settime', 'desc')->limit(5)->get(['id', 'big_coversrc', 'title', 'name', 'alias_name', 'type'])->toArray();
        if ($fivecover_movie) {
            array_walk($fivecover_movie, $form_movie_arr);
        }
        //带图片的最新电影
        $newest_movie = Movie::orderBy('created_at', 'desc')->limit(16)->get($this->pic_field)->toArray();
        if ($newest_movie) {
            array_walk($newest_movie, $form_movie_arr);
        }
        //获取每个区域的最新的id 列表
        $regionnewlist = $this->getRegionNewList($form_movie_arr);
        //底部最热电影
        $hotmovie_list = $this->getHotMovie($form_movie_arr);
        //博主影片推荐
        $recommendmovie_list = $this->getRecommendMovie($form_movie_arr);
        //热映电影
        $screenmovie_list = $this->getScreenMovie($form_movie_arr);

        /****************************************/
        return compact('tdk_html', 'menu', 'fivecover_movie', 'newest_movie', 'hotmovie_list', 'regionnewlist', 'recommendmovie_list', 'screenmovie_list');
    }


    /**
     * 获取电影列表必须的元素
     * @access public
     * @param $region_enname
     * @param $pagenum
     * @param int $pagesize
     * @return array
     */
    public function getMovieListEnsstial($region_enname, $pagenum, $pagesize = 1)
    {
        $form_movie_arr = [$this, 'execFormatMovie'];
        switch ($region_enname) {
            case 'oumei':
                $region_id = 1;
                $region_name = '欧美电影';
                break;
            case 'rihan':
                $region_id = 2;
                $region_name = '日韩电影';
                break;
            case 'dalu':
                $region_id = 4;
                $region_name = '大陆电影';
                break;
            case 'gangtai':
                $region_id = 3;
                $region_name = '港台电影';
                break;
            case 'jingdian':
                $region_id = 5;
                $region_name = '经典电影';
                break;
        }
        $current = sprintf('/%s.html', $region_enname);
        //面包屑导航
        $breadcrumb = $this->breadcrumb;
        array_push($breadcrumb, [
            'text' => $region_name,
            'href' => $current,
            'title' => $region_name,
        ]);
        $this->breadcrumb;
        //菜单元素
        $menu = (new Menu())->get_menu($region_enname);
        //关键词元素
        $tdk_html = (new Tdk())->get_tdk($region_enname);
        //获取每个区域的最新的id 列表
        $regionnewlist = $this->getRegionNewList($form_movie_arr);
        //底部最热电影
        $hotmovie_list = $this->getHotMovie($form_movie_arr);
        //博主影片推荐
        $recommendmovie_list = $this->getRecommendMovie($form_movie_arr);
        //获取正在热映的电影列表
        $screenmovie_list = $this->getScreenMovie($form_movie_arr);

        //电影列表 同事计算分页相关
        $movies = Movie::where('region_id', $region_id)->orderBy('id', 'desc')->limit($pagesize)->offset($pagesize * ($pagenum - 1))->get($this->pic_field)->toArray();
        array_walk($movies, $form_movie_arr);
        $count = Movie::where('region_id', $region_id)->count();
        $allpagenum = ceil($count / $pagesize);
        $pagination = $this->multipage($allpagenum, $pagenum, 'oumei');
        return compact('tdk_html', 'menu', 'hotmovie_list', 'current', 'breadcrumb', 'region_name', 'regionnewlist', 'recommendmovie_list', 'screenmovie_list', 'movies', 'allpagenum', 'count', 'pagination');
    }


    /**
     * 获取电影详情需要的元素
     * @access public
     */
    public function getMovieEnsstial($id)
    {
        $form_movie_arr = [$this, 'execFormatMovie'];
        $movie = Movie::find($id)->toArray();
        $downloadlink = Moviedownloadlink::where('movie_id', $id)->get(['id', 'type_name', 'href'])->toArray();
        $imglist = Movieimglist::where('movie_id', $id)->get(['id', 'imgsrc'])->toArray();
        $en_name = '';
        switch ($movie['region_id']) {
            case'1':
                $en_name = 'oumei';
                break;
            case'2':
                $en_name = 'rihan';
                break;
            case'3':
                $en_name = 'dalu';
                break;
            case'4':
                $en_name = 'gangtai';
                break;
            case'5':
                $en_name = 'jingdian';
                break;
        }

        //面包屑导航
        $breadcrumb = $this->breadcrumb;
        $current = sprintf('/movie/%s.html', $id);
        array_push($breadcrumb, [
            'text' => $movie['region_name'],
            'href' => '/' . $en_name . '.html',
            'title' => $movie['region_name'],
        ]);
        array_push($breadcrumb, [
            'text' => $movie['name'],
            'href' => $current,
            'title' => $movie['title'],
        ]);
        //菜单元素
        $menu = (new Menu())->get_menu($en_name);
        //关键词元素
        $tdk_html = (new Tdk())->get_tdk('movie', $movie['name']);
        //获取每个区域的最新的id 列表
        $regionnewlist = $this->getRegionNewList($form_movie_arr);
        //底部最热电影
        $hotmovie_list = $this->getHotMovie($form_movie_arr);
        //博主影片推荐
        $recommendmovie_list = $this->getRecommendMovie($form_movie_arr);
        //热映电影
        $screenmovie_list = $this->getScreenMovie($form_movie_arr);
        /****************************************/
        $this->form_per_movie($movie);
        return compact('movie', 'tdk_html', 'menu', 'breadcrumb', 'fivecover_movie', 'newest_movie', 'hotmovie_list', 'regionnewlist', 'recommendmovie_list', 'screenmovie_list');
    }


    /**
     * 格式化每一条数据
     * @access  public
     */
    private function form_per_movie(&$v)
    {
        $type = $this->movietype;
        //首先格式化电影
        $v['href'] = "/movie/{$v['id']}.html";
        if (array_key_exists('type', $v)) {
            $type_id = array_filter(explode(',', $v['type']));
            $type = [];
            foreach ($type_id as $value) {
                $type[] = [
                    'id' => $value,
                    'href' => sprintf($this->type_path, $value),
                    'name' => $this->movietype[$value]
                ];
            }
            $v['type'] = $type;
        }
        if (array_key_exists('created_at', $v)) {
            $v['created_at'] = date('Y年m月d日', $v['created_at']);
        }
    }


    /**
     * @param $maxpage 总页数
     * @param $page  当前页
     * @param string $para 翻页参数(不需要写$page),$para参数就应该设为'&id=1'
     * @return string 返回的输出分页html内容
     */
    function multipage($allpagenum, $currentpage, $page_en, $para = '')
    {
        $para = $para ? '?' . $para : '';
        $pagestring = '';
        //一次显示分页数量为五条
        $listnum = 5;
        //默认选中的位置为第三个 也就是始终在中间
        $offset = 2;
        $from = $currentpage - $offset;
        $to = $currentpage + $offset;
        if ($to > $allpagenum) {
            $to = $allpagenum;
        }
        if ($from <= 0) {
            $from = 1;
        }

        if ($from == $to) {
            $pagestring = <<<code
            <li>
              <a href="#" aria-label="Previous" class="disabled">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="disabled"><a href="">1</a></li>
            <li>
              <a class="disabled" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
code;
            return $pagestring;
        }
        //没有第一页
        $pagestring .=
            "<li><a href='/{$page_en}/1.html?{$para}'>第一页</a></li>" .
            "<li><a href='/{$page_en}/" . ($currentpage - 1) . ".html{$para}' $para >«</a></li>";

        for ($i = $from; $i <= $to; $i++) {
            $pagestring .= $i == $currentpage ? "<li class='active'><a href='/{$page_en}/{$i}.html{$para}'>{$i}</a></li>" :
                "<li><a href='/{$page_en}/{$i}.html{$para}'>{$i}</a></li>";
        }

        if ($to != $currentpage) {
            //表示不是最后一页
            $pagestring .=
                "<li><a href='/{$page_en}/{$to}.html{$para}' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>" .
                "<li><a href='/{$page_en}/{$allpagenum}.html{$para}'>最后一页</a></li>";
        }
        return $pagestring;
    }


    /**
     * 获取每个地区的最新的电影 列表 获取十条
     * @param $form_movie_arr
     * @param $movietype
     * @return array
     */
    private function getRegionNewList($form_movie_arr, $limit = 10)
    {
        /**列表类型的**************************************/
        //然后分别获取十条最新更新的电影 1欧美　　2日韩　3港台 4大陆
        $field = ['id', 'title', 'name', 'alias_name', 'type', 'created_at'];
        $oumeilist = Movie::where('region_id', '1')->orderBy('id', 'desc')->limit($limit)->get($field)->toArray();
        $dalulist = Movie::where('region_id', '4')->orderBy('id', 'desc')->limit($limit)->get($field)->toArray();
        $rihanlist = Movie::where('region_id', '2')->orderBy('id', 'desc')->limit($limit)->get($field)->toArray();
        $gangtailist = Movie::where('region_id', '3')->orderBy('id', 'desc')->limit($limit)->get($field)->toArray();
        if ($oumeilist) {
            array_walk($oumeilist, $form_movie_arr);
        }
        if ($dalulist) {
            array_walk($dalulist, $form_movie_arr);
        }
        if ($rihanlist) {
            array_walk($rihanlist, $form_movie_arr);
        }
        if ($gangtailist) {
            array_walk($gangtailist, $form_movie_arr);
        }
        //四个区域最新电影推荐
        return [
            [
                'name' => '欧美最新更新',
                'href' => '/oumei.html',
                'title' => '欧美电影列表',
                'list' => $oumeilist
            ],
            [
                'name' => '大陆最新更新',
                'href' => '/dalu.html',
                'title' => '大陆电影列表',
                'list' => $dalulist
            ],
            [
                'name' => '日韩最新更新',
                'href' => '/rihan.html',
                'title' => '日韩电影列表',
                'list' => $rihanlist
            ],
            [
                'name' => '港台最新更新',
                'href' => '/gangtai.html',
                'title' => '港台电影列表',
                'list' => $gangtailist
            ]
        ];

    }

    /**
     * 获取正在热映的电影
     * @access private
     */
    private function getScreenMovie($form_movie_arr, $limit = 10)
    {
        //热映电影
        $field = ['id', 'title', 'name', 'alias_name', 'type', 'created_at'];
        $screenmovie_list = Movie::where('is_screen', '20')->orderBy('screen_settime', 'desc')->limit($limit)->get($field)->toArray();
        array_walk($screenmovie_list, $form_movie_arr);
        return $screenmovie_list;
    }


    /**
     * 获取热门电影相关 带图片
     * @param $pic_field 要从数据库中取出来的字段
     * @param $form_movie_arr 格式化电影列表的字段
     * @param $movietype 电影类型数据
     * @param $limit 取出多少条
     * @return array
     */
    private function getHotMovie($form_movie_arr, $limit = 8)
    {
        //热门电影 取热门电影12条来
        $hotmovie_list = Movie::where('is_hot', '20')->orderBy('hot_settime', 'desc')->limit($limit)->get($this->pic_field)->toArray();
        array_walk($hotmovie_list, $form_movie_arr);
        return $hotmovie_list;
    }


    /**
     * 获取博主推荐的电影
     * @param $form_movie_arr
     * @param $movietype
     * @param $limit
     * @return array
     */
    private function getRecommendMovie($form_movie_arr, $limit = 10)
    {
        //博主影片推荐
        $field = ['id', 'title', 'name', 'alias_name', 'type', 'created_at'];
        $recommendmovie_list = Movie::where('is_recommend', '20')->orderBy('recommend_settime', 'desc')->limit($limit)->get($field)->toArray();
        array_walk($recommendmovie_list, $form_movie_arr);
        return $recommendmovie_list;
    }


    /**
     * 格式化电影字段
     * @access private
     */
    private function execFormatMovie(&$v, $k)
    {
        //首先格式化电影
        $v['href'] = "/movie/{$v['id']}.html";
        if (array_key_exists('type', $v)) {
            $type_id = array_filter(explode(',', $v['type']));
            $type = [];
            foreach ($type_id as $value) {
                $type[] = [
                    'id' => $value,
                    'href' => sprintf($this->type_path, $value),
                    'name' => $this->movietype[$value]
                ];
            }
            $v['type'] = $type;
        }
        if (array_key_exists('created_at', $v)) {
            $v['created_at'] = date('Y年m月d日', $v['created_at']);
        }
    }


}
