@extends('app')

@section('breadcrumb')
    <div class="container">
        <ol class="breadcrumb">
            <?php
            foreach($breadcrumb as $k=>$v){
            ?>
            <li><a href="{{$v['href']}}" title="{{$v['title']}}">{{$v['text']}}</a></li>
            <?php
            }
            ?>
        </ol>
    </div>
@endsection

@section('content')
    <div class="col-lg-9 col-md-9 col-xs-12">
        <div class="list-container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class=" col-lg-4 col-md-12 col-sm-12">
                                <a href="#" class="thumbnail">
                                    <img src="{{$movie['coversrc']}}" alt="{{$movie['name']}}"
                                         title="{{$movie['title']}}">
                                </a>
                            </div>
                            <div class=" col-lg-8 col-md-12 col-sm-12">
                                <div class="">
                                    <h1 class="movie-title">
                                        <a href="{{$movie['href']}}" title="{{$movie['title']}}">{{$movie['name']}}</a>
                                        <span class="movie-title-year">({{$movie['ages']}})</span>
                                    </h1>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="">
                                            更新：{{$movie['releasedate']}}
                                        </div>
                                        <div class="">
                                            状态：高清
                                        </div>
                                        <div class="">
                                            地区：<a href="">{{$movie['region_name']}}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="container-fluid">
                                            {{$movie['doubanscore']}}
                                        </div>
                                        <div class="container-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    语言：{{$movie['language']}}
                                </div>
                                <div class="">
                                    类型：
                                    <?php
                                    foreach ($movie['type'] as $val) {
                                    ?>
                                    <a href='{{$val['href']}}' target="_blank">{{$val['name']}}</a>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="">
                                    主演：{{$movie['starring']}}
                                </div>
                                <div class="">
                                    剧情介绍：
                                </div>
                                <div class="movie-detail-list-des">
                                    {{$movie['summary']}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-middle-container list-container container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h2 class="title">{{$movie['title']}}</h2>
                        <div class="content">
                            {!!$movie['content'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="list-middle-container list-container container-fluid download-link">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h2 class="title">迅雷下载</h2>
                        <div class="content recent-post">
                            <div class="recent-single-post">
                                <a href="/custom-excerpts/" class="post-title">自定义文章摘要（Excerpt）
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-middle-container list-container container-fluid download-link">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h2 class="title">BT下载</h2>
                        <div class="content recent-post">
                            <div class="recent-single-post">
                                <a href="/custom-excerpts/" class="post-title">自定义文章摘要（Excerpt）
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-middle-container list-container container-fluid download-link">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h2 class="title">电驴下载</h2>
                        <div class="content recent-post">
                            <div class="recent-single-post">
                                <a href="/custom-excerpts/" class="post-title">自定义文章摘要（Excerpt）
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-middle-container list-container container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h4 class="title">相关推荐</h4>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 col-lg-3">
                                    <a href="#" class="thumbnail">
                                        <img src="image/demo.jpg" alt="欧美电影">
                                        <div class="row">
                                            <div class="col-lg-12 movie-list-title">国境线</div>
                                        </div>
                                        <div class="row" style="padding-left: 15px">
                                            <div class="movie-list-desc">
                                                2017 欧美 战争 动作 历史 新闻
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-3">
                                    <a href="#" class="thumbnail">
                                        <img src="image/demo1.jpg" alt="欧美电影">
                                        <div class="row">
                                            <div class="col-lg-12 movie-list-title" title="2017年8月12日">台北物语
                                            </div>
                                        </div>
                                        <div class="row" style="padding-left: 15px">
                                            <div class="movie-list-desc">
                                                2017 欧美 战争 动作 历史 新闻
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-3">
                                    <a href="#" class="thumbnail">
                                        <img src="image/head-bg.jpg" alt="欧美电影">
                                        <div class="row">
                                            <div class="col-lg-12 movie-list-title">战狼2</div>
                                        </div>
                                        <div class="row" style="padding-left: 15px">
                                            <div class="movie-list-desc">
                                                2017 欧美 战争 动作 历史 新闻
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-3">
                                    <a href="#" class="thumbnail">
                                        <img src="image/head-bg.jpg" alt="欧美电影">
                                        <div class="row">
                                            <div class="col-lg-12 movie-list-title">战狼2</div>
                                        </div>
                                        <div class="row" style="padding-left: 15px">
                                            <div class="movie-list-desc">
                                                2017 欧美 战争 动作 历史 新闻
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="list-middle-container list-container container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h4 class="title">电影影评</h4>
                        <div class="content recent-post">
                            <div class="recent-single-post">
                                <a href="/custom-excerpts/" class="post-title">自定义文章摘要（Excerpt）
                                    <div class="date">2017年8月9日</div>
                                </a>
                            </div>
                            <div class="recent-single-post">
                                <a href="/primary-tags/" class="post-title">首要“标签”</a>
                                <div class="date">2017年8月3日</div>
                            </div>
                            <div class="recent-single-post">
                                <a href="/ghost-1-0-released/" class="post-title">Ghost 1.0 版本正式发布</a>
                                <div class="date">2017年7月29日</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
