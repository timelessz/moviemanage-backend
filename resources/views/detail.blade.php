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
                                         title="{{$movie['title']}}" class="detail-thumbnail">
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
                                        <div class="detail-field">
                                            <span>更新</span>：{{date('Y-m-d H:i')}}
                                        </div>
                                        <div class="detail-field">
                                            <span>状态</span>：高清
                                        </div>
                                        <div class="detail-field">
                                            <span>地区</span>：<a href="">{{$movie['region_name']}}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="container-fluid doubanscore" title="豆瓣评分">
                                            {{$movie['doubanscore']}}
                                        </div>
                                        <div class="container-fluid">
                                            <div class="bdsharebuttonbox">
                                                <a href="#" class="bds_more" data-cmd="more"></a>
                                                <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                                                <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                                                <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                                                <a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
                                                <a href="#" class="bds_tieba" data-cmd="tieba" title="分享到百度贴吧"></a>
                                                <a href="#" class="bds_bdhome" data-cmd="bdhome" title="分享到百度新首页"></a>
                                            </div>
                                            <script>window._bd_share_config = {
                                                    "common": {
                                                        "bdSnsKey": {},
                                                        "bdText": "",
                                                        "bdMini": "1",
                                                        "bdMiniList": false,
                                                        "bdPic": "",
                                                        "bdStyle": "1",
                                                        "bdSize": "16"
                                                    }, "share": {}
                                                };
                                                with (document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];</script>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-field">
                                    <span> 语言</span>：{{$movie['language']}}
                                </div>
                                <div class="detail-field">
                                    <span>类型</span>：
                                    <?php
                                    foreach ($movie['type'] as $val) {
                                    ?>
                                    <a href='{{$val['href']}}' target="_blank">{{$val['name']}}</a>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="detail-field">
                                    <span>主演</span>：{{$movie['starring']}}
                                </div>
                                <div class="detail-field">
                                    <span>剧情介绍</span>：
                                </div>
                                <div class="detail-field">
                                    <span>上映时间</span>：
                                    {{$movie['releasedate']}}
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
                        foreach ($v['list'] as $val){
                        ?>
                        <div class="content recent-post">
                            <div class="recent-single-post">
                                <a href="{{$val['href']}}" target="_blank"
                                   class="post-title">{{$val['text']}} {{$str}}{{$val['pwd']}}
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
        if($movie['comment']){
        ?>
        <div class="list-middle-container list-container container-fluid recommend_reason">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h2 class="title">热门评论</h2>
                        <div class="content comment-container">
                            {!!$movie['comment'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php
        if($movie['recommend_reason']){
        ?>
        <div class="list-middle-container list-container container-fluid recommend_reason">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h2 class="title">博主推荐</h2>
                        <div class="content recommend-container">
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