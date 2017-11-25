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
                                        <div class="container-fluid doubanscore" title="豆瓣评分">
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
        <div class="list-middle-container list-container container-fluid ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h2 class="title">{{$movie['title']}}</h2>
                        <div class="content movie-container">
                            {!!$movie['content'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>
        <script src="{{URL::asset('dist/getThunderUrl/ThunderURIEncode.js')}}"></script>
        <script>
            $(function () {
                $(".xunlei").each(function () {
                    var href = $(this).attr('href');
                    var thunderLink = ThunderURIEncode(href);
                    $(this).attr('href', thunderLink);
                });
//                var href = $(this).attr('href');
//                var thunderLink = ThunderURIEncode(url);
//                $(this).attr('href', thunderLink);

                return false;
            });
        </script>
        <?php
        foreach ($d_link as $k => $v) {

        ?>
        <div class="list-middle-container list-container container-fluid download-link">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h2 class="title">{{$v['type_name']}}</h2>
                        <?php
                        $str = $k == 4 ? '密码:' : '';
                        $xunleiflag = $k == 3 ? 'xunlei' : '';
                        foreach ($v['list'] as $val){
                        ?>
                        <div class="content recent-post">
                            <div class="recent-single-post">
                                <a href="{{$val['href']}}" target="_blank"
                                   class="post-title {{$xunleiflag}}">{{$val['text']}} {{$str}}{{$val['pwd']}}
                                </a>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
        }
        ?>

        <?php
        if($movie['recommend_reason']){
        ?>
        <div class="list-middle-container list-container container-fluid recommend_reason">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h2 class="title">博主推荐</h2>
                        <div class="content">
                            {!!$movie['recommend_reason'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php
        if ($review) {
        ?>
        <div class="list-middle-container list-container container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="widget">
                        <h4 class="title">电影影评</h4>
                        <div class="content recent-post">
                            <?php
                            foreach ($review as $v){
                            ?>
                            <div class="recent-single-post">
                                <a href="{{$v['href']}}" class="post-title" title="{{$v['title']}}">
                                    {{$v['title']}}
                                </a>
                                <div class="date pull-right">{{$v['created_at']}}</div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php
        }
        ?>
        <?php
        if($relative_movies){
        ?>
        <div class="list-middle-container list-container container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h4 class="title">相关推荐</h4>
                        <div class="container-fluid">

                            <div class="row">
                                <?php
                                foreach ($relative_movies as $v) {
                                ?>
                                <div class="col-xs-6 col-md-4 col-lg-3" style="padding-left:8px;padding-right:8px;">
                                    <div class="thumbnail" style="margin-bottom: 15px;margin-top: 0px">
                                        <a href="{{$v['href']}}" title="{{$v['title']}}">
                                            <img src="{{$v['coversrc']}}" alt="{{$v['title']}}" style="height:240px">
                                        </a>
                                        <div class="row">
                                            <div class="col-lg-12 movie-list-title"
                                                 style="width:100%;overflow:hidden;white-space:nowrap;text-overflow:ellipsis">
                                                <a href="{{$v['href']}}" title="{{$v['title']}}">
                                                    {{$v['name']}}
                                                </a>
                                                <span class="movie-score" title="豆瓣评分{{$v['doubanscore']}}">
                                            {{$v['doubanscore']}}
                                        </span>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-left:15px">
                                            <div class="movie-list-desc">
                                                {{$v['ages']}} {{$v['region_name']}}
                                                <?php
                                                foreach ($v['type'] as $val) {
                                                ?>
                                                <a href='{{$val['href']}}' target="_blank">{{$val['name']}}</a>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>

    </div>
@endsection
