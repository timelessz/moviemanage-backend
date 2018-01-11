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

        <div class="list-container container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h2 class="title">{{$moviereview['title']}}</h2>
                        <div class="content review-container">
                            {!!$moviereview['content'] !!}
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
            </div>
        </div>


        <?php
        if ($relative_movie) {
        ?>
        <div class="list-container container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h4 class="title">相关电影</h4>
                        <div class="content recent-post">

                            <div class="recent-single-post">
                                <a href="{{$relative_movie['href']}}" class="post-title"
                                   title="{{$relative_movie['title']}}">
                                    {{$relative_movie['title']}}
                                </a>
                                <div class="date pull-right">{{$relative_movie['created_at']}}</div>
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
