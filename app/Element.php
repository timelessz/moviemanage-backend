<?php

namespace App;

use Illuminate\Support\Facades\Cache;

class Element
{

    //带图片的需要展现的字段列表
    private $pic_field = ['id', 'name', 'title', 'ages', 'summary', 'coversrc', 'type', 'doubanscore', 'region_id', 'region_name', 'director', 'created_at', 'country'];
    private $movietype = [];
    private $tag_path = '/tag-%s.html';
    private $type_path = '/type-%s.html';
    private $review = '/review/%s.html';
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
        //热映电影
        $screenmovie_list = $this->getScreenMovie($form_movie_arr);
        /**右侧相关菜单推荐*************************************/
        //电影分类
        $movietype = $this->getMovieType();
        //博主影片推荐
        $recommendmovie_list = $this->getRecommendMovie($form_movie_arr);
        /**********************************************/
        $footer_reviews = $this->getFooterMovieReview();
        $footer_tags = $this->getFooterMovieTag();
        $footer_types = $this->getFooterMovieType();
        return compact('tdk_html', 'menu', 'fivecover_movie', 'newest_movie', 'hotmovie_list', 'regionnewlist', 'recommendmovie_list', 'screenmovie_list', 'movietype', 'footer_reviews', 'footer_tags', 'footer_types');
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
        $name = $region_name;
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
        //获取正在热映的电影列表
        $screenmovie_list = $this->getScreenMovie($form_movie_arr);

        /**右侧相关菜单推荐*************************************/
        //电影分类
        $movietype = $this->getMovieType();
        //博主影片推荐
        $recommendmovie_list = $this->getRecommendMovie($form_movie_arr);
        /**********************************************/

        //电影列表 同事计算分页相关
        $movies = Movie::where('region_id', $region_id)->orderBy('id', 'desc')->limit($pagesize)->offset($pagesize * ($pagenum - 1))->get($this->pic_field)->toArray();
        array_walk($movies, $form_movie_arr);
        $count = Movie::where('region_id', $region_id)->count();
        $allpagenum = ceil($count / $pagesize);
        $pagination = $this->multipage($allpagenum, $pagenum, 'oumei');
        $footer_reviews = $this->getFooterMovieReview();
        $footer_tags = $this->getFooterMovieTag();
        $footer_types = $this->getFooterMovieType();
        return compact('tdk_html', 'menu', 'hotmovie_list', 'current', 'breadcrumb', 'name', 'regionnewlist', 'recommendmovie_list', 'screenmovie_list', 'movietype', 'movies', 'allpagenum', 'count', 'pagination', 'footer_reviews', 'footer_tags', 'footer_types');
    }


    /**
     * 获取分类的电影列表
     * @access public
     */
    public function getTypeMovieListEnsstial($type_id, $pagenum, $pagesize = 10)
    {
        $form_movie_arr = [$this, 'execFormatMovie'];
        //首先需要根据$type_id 来获取
        $movietype = $this->getMovieType();
        $typeinfo = $movietype[$type_id];
        $name = $typeinfo['name'];
        $current = sprintf($this->type_path, $type_id);
        //面包屑导航
        $breadcrumb = $this->breadcrumb;
        array_push($breadcrumb, [
            'text' => $name,
            'href' => $current,
            'title' => $name,
        ]);
        $this->breadcrumb;
        //菜单元素
        $menu = (new Menu())->get_menu('type');
        //关键词元素
        $tdk_html = (new Tdk())->get_tdk('type', $name);

        //获取每个区域的最新的id 列表
        $regionnewlist = $this->getRegionNewList($form_movie_arr);
        //底部最热电影
        $hotmovie_list = $this->getHotMovie($form_movie_arr);
        //获取正在热映的电影列表
        $screenmovie_list = $this->getScreenMovie($form_movie_arr);

        /**右侧相关菜单推荐*************************************/
        //博主影片推荐
        $recommendmovie_list = $this->getRecommendMovie($form_movie_arr);
        /**********************************************/

        //电影列表 同事计算分页相关
        $movies = Movie::where('type', 'like', ",$type_id,")->orderBy('id', 'desc')->limit($pagesize)->offset($pagesize * ($pagenum - 1))->get($this->pic_field)->toArray();
        array_walk($movies, $form_movie_arr);
        $count = Movie::where('type', 'like', ",$type_id,")->count();
        $allpagenum = ceil($count / $pagesize);
        $pagination = $this->multipage($allpagenum, $pagenum, 'type-' . $type_id, '');
        $footer_reviews = $this->getFooterMovieReview();
        $footer_tags = $this->getFooterMovieTag();
        $footer_types = $this->getFooterMovieType();
        return compact('tdk_html', 'menu', 'hotmovie_list', 'current', 'breadcrumb', 'name', 'regionnewlist', 'recommendmovie_list', 'screenmovie_list', 'movietype', 'movies', 'allpagenum', 'count', 'pagination', 'footer_reviews', 'footer_tags', 'footer_types');
    }


    /**
     * 获取分类的电影列表
     * @access public
     */
    public function getTagMovieListEnsstial($tag_id, $pagenum, $pagesize = 10)
    {
        $form_movie_arr = [$this, 'execFormatMovie'];
        $movietype = $this->getMovieType();

        $movietag = $this->getMovieTag();
        $taginfo = $movietag[$tag_id];
        $name = $taginfo['name'];
        $current = sprintf($this->tag_path, $tag_id);
        //面包屑导航
        $breadcrumb = $this->breadcrumb;
        array_push($breadcrumb, [
            'text' => $name,
            'href' => $current,
            'title' => $name,
        ]);
        $this->breadcrumb;
        //菜单元素
        $menu = (new Menu())->get_menu('tag');
        //关键词元素
        $tdk_html = (new Tdk())->get_tdk('tag', $name);
        //获取每个区域的最新的id 列表
        $regionnewlist = $this->getRegionNewList($form_movie_arr);
        //底部最热电影
        $hotmovie_list = $this->getHotMovie($form_movie_arr);
        //获取正在热映的电影列表
        $screenmovie_list = $this->getScreenMovie($form_movie_arr);

        /**右侧相关菜单推荐*************************************/
        //博主影片推荐
        $recommendmovie_list = $this->getRecommendMovie($form_movie_arr);
        /**********************************************/

        //电影列表 同事计算分页相关
        $movies = Movie::where('tags', 'like', ",$tag_id,")->orderBy('id', 'desc')->limit($pagesize)->offset($pagesize * ($pagenum - 1))->get($this->pic_field)->toArray();
        array_walk($movies, $form_movie_arr);
        $count = Movie::where('tags', 'like', ",$tag_id,")->count();
        $allpagenum = ceil($count / $pagesize);
        $pagination = $this->multipage($allpagenum, $pagenum, 'tag-' . $tag_id, '');
        $footer_reviews = $this->getFooterMovieReview();
        $footer_tags = $this->getFooterMovieTag();
        $footer_types = $this->getFooterMovieType();
        return compact('tdk_html', 'menu', 'hotmovie_list', 'current', 'breadcrumb', 'name', 'regionnewlist', 'recommendmovie_list', 'screenmovie_list', 'movietype', 'movies', 'allpagenum', 'count', 'pagination', 'footer_reviews', 'footer_tags', 'footer_types');
    }

    /**
     * 获取展现页面需要的电影标签或者电影分类的必须的元素
     * @param string $flag 标志类型是tag 还是type
     */
    public function getTagTypeEnsstial($flag = 'tag')
    {
        $form_movie_arr = [$this, 'execFormatMovie'];
        $movietype = $this->getMovieType();
//        $movietag = $this->getMovieTag();
        if ($flag == 'tag') {
            //菜单元素
            $menu = (new Menu())->get_menu('tag');
            $name = '电影标签';
            $current = '/typelist.html';
            $list = Movietag::all(['id', 'name', 'detail'])->toArray();
        } else if ($flag = 'type') {
            //菜单元素
            $menu = (new Menu())->get_menu('type');
            $name = '电影分类';
            $current = '/taglist.html';
            $list = Movietype::all(['id', 'name', 'detail'])->toArray();
        }
        $form_tagtype_arr = [$this, 'execFormatTagType'];
        if ($list) {
            array_walk($list, $form_tagtype_arr, $flag);
        }
        //面包屑导航
        $breadcrumb = $this->breadcrumb;
        array_push($breadcrumb, [
            'text' => $name,
            'href' => $current,
            'title' => $name,
        ]);
        $this->breadcrumb;

        //关键词元素
        $tdk_html = (new Tdk())->get_tdk($flag, $name);
        //获取每个区域的最新的id 列表
        $regionnewlist = $this->getRegionNewList($form_movie_arr);
        //底部最热电影
        $hotmovie_list = $this->getHotMovie($form_movie_arr);
        //获取正在热映的电影列表
        $screenmovie_list = $this->getScreenMovie($form_movie_arr);

        /**右侧相关菜单推荐*************************************/
        //博主影片推荐
        $recommendmovie_list = $this->getRecommendMovie($form_movie_arr);
        /**********************************************/

        $footer_reviews = $this->getFooterMovieReview();
        $footer_tags = $this->getFooterMovieTag();
        $footer_types = $this->getFooterMovieType();
        return compact('tdk_html', 'menu', 'hotmovie_list', 'current', 'list', 'breadcrumb', 'name', 'regionnewlist', 'movietype', 'recommendmovie_list', 'screenmovie_list', 'movies', 'allpagenum', 'count', 'pagination', 'footer_reviews', 'footer_tags', 'footer_types');

    }


    /**
     *
     */
    public function execFormatTagType(&$v, $k, $flag)
    {
        if ($flag == 'tag') {
            $v['href'] = sprintf($this->tag_path, $v['id']);
        } else if ($flag == 'type') {
            $v['href'] = sprintf($this->type_path, $v['id']);
        }
    }


    /**
     * 获取电影详情需要的元素
     * @access public
     */
    public function getMovieEnsstial($id)
    {
        $movie = Movie::find($id)->toArray();
        return $this->getMovieCompact($movie);
    }

    /**
     * 获取电影分类
     * @access public
     */
    public function getMovieCompact($movie)
    {
        $id = $movie['id'];
        $form_movie_arr = [$this, 'execFormatMovie'];
        $downloadlink = Moviedownloadlink::where('movie_id', $id)->get(['id', 'type_name', 'type_id', 'href', 'pwd', 'text'])->toArray();
        //整理下下载链接把 同类的整合到一个里边
        $d_link = [];
        foreach ($downloadlink as $k => $v) {
            if (array_key_exists($v['type_id'], $d_link)) {
                array_push(
                    $d_link[$v['type_id']]['list'],
                    [
                        'href' => $v['href'],
                        'text' => $v['text'],
                        'pwd' => $v['pwd']
                    ]
                );
            } else {
                $d_link[$v['type_id']] = [
                    'type_name' => $v['type_name'],

                    'list' => [
                        [
                            'href' => $v['href'],
                            'text' => $v['text'],
                            'pwd' => $v['pwd']
                        ]
                    ]
                ];
            }
        }

//      $imglist = Movieimglist::where('movie_id', $id)->get(['id', 'imgsrc'])->toArray();
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
        //热映电影
        $screenmovie_list = $this->getScreenMovie($form_movie_arr);
        /**右侧相关菜单推荐*************************************/
        //电影分类
        $movietype = $this->getMovieType();
        //博主影片推荐
        $recommendmovie_list = $this->getRecommendMovie($form_movie_arr);
        //获取电影影评
        $review = $this->getMovieReview($id);
//        print_r($review);
        /**********************************************/
        //获取相关的电影
        $relative_movies = $this->getRelativeMovie($movie['type'], $id);
        $this->form_per_movie($movie);
        $footer_reviews = $this->getFooterMovieReview();
        $footer_tags = $this->getFooterMovieTag();
        $footer_types = $this->getFooterMovieType();
        return compact('movie', 'tdk_html', 'd_link', 'menu', 'breadcrumb', 'fivecover_movie', 'review', 'relative_movies', 'newest_movie', 'hotmovie_list', 'regionnewlist', 'recommendmovie_list', 'screenmovie_list', 'movietype', 'footer_reviews', 'footer_tags', 'footer_types');

    }

    /**
     * 获取电影影评list
     * @access public
     */
    public function getYingpingListEnsstial($pagenum, $pagesize = 10)
    {
        $form_movie_arr = [$this, 'execFormatMovie'];
        $name = '影视前沿';
        //首先需要根据$type_id 来获取
        $current = sprintf('/yingping-%s.html', $pagenum);
        //面包屑导航

        $breadcrumb = $this->breadcrumb;
        array_push($breadcrumb, [
            'text' => '影评',
            'href' => $current,
            'title' => '影评',
        ]);
        $this->breadcrumb;

        //菜单元素
        $menu = (new Menu())->get_menu('yingping');
        //关键词元素
        $tdk_html = (new Tdk())->get_tdk('yingping');
        //电影分类
        $movietype = $this->getMovieType();
        //获取每个区域的最新的id 列表
        $regionnewlist = $this->getRegionNewList($form_movie_arr);
        //底部最热电影
        $hotmovie_list = $this->getHotMovie($form_movie_arr);
        //获取正在热映的电影列表
        $screenmovie_list = $this->getScreenMovie($form_movie_arr);

        /**右侧相关菜单推荐*************************************/
        //博主影片推荐
        $recommendmovie_list = $this->getRecommendMovie($form_movie_arr);
        /**********************************************/

        //电影列表 同事计算分页相关
        $moviereviews = Moviereview::orderBy('id', 'desc')->limit($pagesize)->offset($pagesize * ($pagenum - 1))->get($this->movieReview)->toArray();
        array_walk($moviereviews, [$this, 'execFormatMoviereviews']);
        $count = Moviereview::count();
        $allpagenum = ceil($count / $pagesize);
        $pagination = $this->multipage($allpagenum, $pagenum, 'yingping', '');
        $footer_reviews = $this->getFooterMovieReview();
        $footer_tags = $this->getFooterMovieTag();
        $footer_types = $this->getFooterMovieType();
        return compact('tdk_html', 'menu', 'hotmovie_list', 'current', 'breadcrumb', 'name', 'regionnewlist', 'recommendmovie_list', 'screenmovie_list', 'movietype', 'moviereviews', 'allpagenum', 'count', 'pagination', 'footer_reviews', 'footer_tags', 'footer_types');
    }

    // 获取电影评论必须的元素
    public function getReviewEnsstial($id)
    {
        $form_movie_arr = [$this, 'execFormatMovie'];
        $moviereview = Moviereview::find($id)->toArray();
        $movie_id = $moviereview['movie_id'];
        $movie_name = $moviereview['movie_name'];

        //面包屑导航
        $breadcrumb = $this->breadcrumb;
        $current = sprintf($this->review, $id);
        array_push($breadcrumb, [
            'text' => '电影评论',
            'href' => '/yingping.html',
            'title' => '电影评论',
        ]);
        array_push($breadcrumb, [
            'text' => $moviereview['title'],
            'href' => $current,
            'title' => $moviereview['title'],
        ]);
        //菜单元素
        $menu = (new Menu())->get_menu('yingping');
        //关键词元素
        $tdk_html = (new Tdk())->get_tdk('review', $movie_name ?: $moviereview['title']);
        //获取每个区域的最新的id 列表
        $regionnewlist = $this->getRegionNewList($form_movie_arr);
        //底部最热电影
        $hotmovie_list = $this->getHotMovie($form_movie_arr);
        //热映电影
        $screenmovie_list = $this->getScreenMovie($form_movie_arr);
        /**右侧相关菜单推荐*************************************/
        //电影分类
        $movietype = $this->getMovieType();
        //博主影片推荐
        $recommendmovie_list = $this->getRecommendMovie($form_movie_arr);
        //相关电影 后期这个地方可以修改为多个电影的形式 暂时只有一个
        $relative_movie = [];
        if ($movie_id) {
            //获取相关的电影
            $relative_movie = Movie::find($movie_id);
            $this->execFormatMovie($relative_movie, 0);
        }
        $footer_reviews = $this->getFooterMovieReview();
        $footer_tags = $this->getFooterMovieTag();
        $footer_types = $this->getFooterMovieType();
        return compact('moviereview', 'tdk_html', 'd_link', 'menu', 'breadcrumb', 'fivecover_movie', 'review', 'relative_movie', 'newest_movie', 'hotmovie_list', 'regionnewlist', 'recommendmovie_list', 'screenmovie_list', 'movietype', 'footer_reviews', 'footer_tags', 'footer_types');
    }

    /**
     * 获取底部电影影评
     */
    private function getFooterMovieReview()
    {
        return Cache::rememberForever('footerMovieReview', function () {
            $moviereview = Moviereview::limit(3)->get($this->movieReview)->toArray();
            array_walk($moviereview, [$this, 'execFormatMoviereviews']);
            return $moviereview;
        });
    }

    /**
     * 获取底部电影标签
     * @access private
     */
    private function getFooterMovieTag()
    {
        return Cache::rememberForever('footerMovieTag', function () {
            $movietag = Movietag::limit(20)->get(['id', 'name', 'detail'])->toArray();
            $tags = [];
            foreach ($movietag as $k => $v) {
                $tags[$v['id']] = [
                    'name' => $v['name'],
                    'href' => sprintf($this->tag_path, $v['id']),
                ];
            }
            return $tags;
        });
    }

    /**
     * 获取去底部电影类型
     * @access private
     */
    private function getFooterMovieType()
    {
        $movietype = Movietype::limit('18')->get(['id', 'name', 'detail'])->toArray();
        $type = [];
        foreach ($movietype as $k => $v) {
            $type[$v['id']] = [
                'name' => $v['name'],
                'href' => sprintf($this->type_path, $v['id']),
            ];
        }
        return $type;
    }


    private $movieReview = ['id', 'title', 'movie_id', 'movie_name', 'thumbnail', 'count', 'summary', 'created_at'];

    /**
     * 获取电影影评
     * @access private
     */
    private function getMovieReview($id)
    {
        $review = Moviereview::where('movie_id', $id)->get($this->movieReview);
        $data = [];
        if ($review) {
            $data = $review->toArray();
            foreach ($data as $k => $v) {
                $this->execFormatMoviereviews($v, 0);
                $data[$k] = $v;
            }
        }
        return $data;
    }


    /**
     * 格式化每一个电影评论
     * @access private
     */
    private function execFormatMoviereviews(&$v, $k)
    {
        if (array_key_exists('created_at', $v)) {
            $v['created_at'] = date('Y-m-d', $v['created_at']);
        }
        $v['href'] = sprintf($this->review, $v['id']);
        if (array_key_exists('summary', $v)) {
            $v['sub_summary'] = trim(mb_substr(strip_tags($v['summary']), 0, 150, 'utf-8')) . '...';
            $v['summary'] = trim(mb_substr(strip_tags($v['summary']), 0, 200, 'utf-8'));
        }
    }


    /**
     * 获取相关联的电影
     * @access private
     */
    private function getRelativeMovie($type_string, $id)
    {
        $types = array_filter(explode(',', $type_string));
        $limit = 4;
        $movies = [];
        foreach ($types as $v) {
            if ($limit <= 0) {
                break;
            }
            $movies_arr = Movie::where('type', 'like', "%,$v,%")->where('id', '!=', $id)->orderBy('id', 'desc')->limit($limit)->get($this->pic_field);
            $p_count = $movies_arr->count();
            $limit = $limit - $p_count;
            foreach ($movies_arr->toArray() as $val) {
                $this->form_per_movie($val);
                array_push($movies, $val);
            }
        }
        return $movies;
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
            "<li><a href='/{$page_en}-1.html?{$para}'>第一页</a></li>" .
            "<li><a href='/{$page_en}-" . ($currentpage - 1) . ".html{$para}' $para >«</a></li>";

        for ($i = $from; $i <= $to; $i++) {
            $pagestring .= $i == $currentpage ? "<li class='active'><a href='/{$page_en}-{$i}.html{$para}'>{$i}</a></li>" :
                "<li><a href='/{$page_en}-{$i}.html{$para}'>{$i}</a></li>";
        }

        if ($to != $currentpage) {
            //表示不是最后一页
            $pagestring .=
                "<li><a href='/{$page_en}-{$to}.html{$para}' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>" .
                "<li><a href='/{$page_en}-{$allpagenum}.html{$para}'>最后一页</a></li>";
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
        return Cache::rememberForever('regionnewlist', function () use ($form_movie_arr, $limit) {
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
        });


    }

    /**
     * 获取正在热映的电影
     * @access private
     */
    private function getScreenMovie($form_movie_arr, $limit = 10)
    {
        return Cache::rememberForever('screenmovie', function () use ($form_movie_arr, $limit) {
            //热映电影
            $field = ['id', 'title', 'name', 'alias_name', 'type', 'created_at'];
            $screenmovie_list = Movie::where('is_screen', '20')->orderBy('screen_settime', 'desc')->limit($limit)->get($field)->toArray();
            array_walk($screenmovie_list, $form_movie_arr);
            return $screenmovie_list;
        });
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
        return Cache::rememberForever('hotmovie', function () use ($form_movie_arr, $limit) {
            //热门电影 取热门电影12条来
            $hotmovie_list = Movie::where('is_hot', '20')->orderBy('hot_settime', 'desc')->limit($limit)->get($this->pic_field)->toArray();
            array_walk($hotmovie_list, $form_movie_arr);
            return $hotmovie_list;
        });
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
        return Cache::rememberForever('recommendmovie', function () use ($form_movie_arr, $limit) {
            //博主影片推荐
            $field = ['id', 'title', 'name', 'alias_name', 'type', 'created_at'];
            $recommendmovie_list = Movie::where('is_recommend', '20')->orderBy('recommend_settime', 'desc')->limit($limit)->get($field)->toArray();
            array_walk($recommendmovie_list, $form_movie_arr);
            return $recommendmovie_list;
        });
    }


    /**
     * 获取电影类型
     * @access private
     */
    private function getMovieType()
    {
        return Cache::rememberForever('MovieType', function () {
            $data = Movietype::get(['id', 'name'])->toArray();
            $type = [];
            foreach ($data as $k => $v) {
                $type[$v['id']] = [
                    'name' => $v['name'],
                    'href' => sprintf($this->type_path, $v['id']),
                ];
            }
            return $type;
        });
    }

    /**
     * 获取电影类型
     * @access private
     */
    private function getMovieTag()
    {
        return Cache::rememberForever('MovieTag', function () {
            $data = Movietag::get(['id', 'name'])->toArray();
            $type = [];
            foreach ($data as $k => $v) {
                $type[$v['id']] = [
                    'name' => $v['name'],
                    'href' => sprintf($this->tag_path, $v['id']),
                ];
            }
            return $type;
        });
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
        $region = [];
        if (array_key_exists('region_id', $v)) {
            $regions = $this->getMovieRegion();
            $v['region'] = [
                'href' => "/{$regions[$v['region_id']]['en_name']}.html",
                'name' => $regions[$v['region_id']]['name']
            ];
        }
        if (array_key_exists('summary', $v)) {
            $v['sub_summary'] = trim(mb_substr(strip_tags($v['summary']), 0, 150, 'utf-8')) . '...';
            $v['summary'] = trim(mb_substr(strip_tags($v['summary']), 0, 200, 'utf-8'));
        }
        if (array_key_exists('created_at', $v)) {
            $v['created_at'] = date('Y年m月d日', $v['created_at']);
        }
    }

    /**
     * 获取电影的区域 信息 用于格式化数据时候使用
     * @access private
     */
    private function getMovieRegion()
    {
        return Cache::rememberForever('region', function () {
            $regions = Movieregion::all(['id', 'name', 'en_name']);
            $l_regions = [];
            foreach ($regions->toArray() as $v) {
                $l_regions[$v['id']] = [
                    'en_name' => $v['en_name'],
                    'name' => $v['name']
                ];
            }
            return $l_regions;
        });
    }


}
