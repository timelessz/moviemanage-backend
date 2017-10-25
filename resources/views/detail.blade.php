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
                                    <img src="image/detail.jpg" alt="缩略图">
                                </a>
                            </div>
                            <div class=" col-lg-8 col-md-12 col-sm-12">
                                <div class="">
                                    <h1 class="movie-title">
                                        绣春刀II：修罗战场 <span class="movie-title-year">(2017)</span>
                                    </h1>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="">
                                            更新：2017-08-12 21:28
                                        </div>
                                        <div class="">
                                            状态：高清
                                        </div>
                                        <div class="">
                                            地区：<a href="">欧美</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="container-fluid">
                                            <input class="input-21c" value="6.7" type="text"
                                                   data-default-caption="{rating} 分" title="" class="rating">
                                        </div>
                                        <div class="container-fluid">
                                            <div class="bdshare">
                                                <div class="bdsharebuttonbox">
                                                    <a href="#" class="bds_weixin" data-cmd="weixin"
                                                       title="分享到微信"></a>
                                                    <a href="#" class="bds_qzone" data-cmd="qzone"
                                                       title="分享到QQ空间"></a>
                                                    <a href="#" class="bds_douban" data-cmd="douban"
                                                       title="分享到豆瓣网"></a>
                                                    <a href="#" class="bds_tsina" data-cmd="tsina"
                                                       title="分享到新浪微博"></a>
                                                    <a href="#" class="bds_tqq" data-cmd="tqq"
                                                       title="分享到腾讯微博"></a>
                                                    <a href="#" class="bds_tieba" data-cmd="tieba"
                                                       title="分享到百度贴吧"></a>
                                                    <a href="#" class="bds_renren" data-cmd="renren"
                                                       title="分享到人人网"></a>
                                                    <a href="#" class="bds_sqq" data-cmd="sqq"
                                                       title="分享到QQ好友"></a>
                                                    <a href="#" class="bds_more" data-cmd="more"></a>
                                                </div>
                                                <script>window._bd_share_config = {
                                                        "common": {
                                                            "bdSnsKey": {},
                                                            "bdText": "",
                                                            "bdMini": "1",
                                                            "bdMiniList": false,
                                                            "bdPic": "",
                                                            "bdStyle": "0",
                                                            "bdSize": "16"
                                                        },
                                                        "share": {},
//                            "image": {
//                                "viewList": ["weixin", "qzone", "douban", "tsina", "tqq", "tieba", "renren", "sqq"],
//                                "viewText": "分享到：",
//                                "viewSize": "16"
//                            },
                                                        "selectShare": {
                                                            "bdContainerClass": null,
                                                            "bdSelectMiniList": ["weixin", "qzone", "douban", "tsina", "tqq", "tieba", "renren", "sqq"]
                                                        }
                                                    };
                                                    with (document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];</script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    语言：<a href="">imdb</a>
                                </div>

                                <div class="">
                                    类型：<a href="">电影</a> <a href="">动作</a> <a href="">战争</a>
                                </div>

                                <div class="">
                                    主演：尼古拉斯.赵兴壮
                                </div>
                                <div class="">
                                    剧情介绍：
                                </div>
                                <div class="movie-detail-list-des">
                                    美国加州的圣佩雷罗港一艘货轮爆炸，死亡27人，9000万美元失踪。事故发生以后，联邦调查局探员白基奇在医院等待昏迷不醒的幸存者；海关特派员大卫（查兹•帕明特里
                                    饰）则对另外一名拿到特赦令的幸存者金特（凯文•史派西 饰）进行了审问。
                                    　　金特供认，在事故中丧生的基顿（加布里埃尔•伯恩 饰）、法特（本尼西奥•德托罗 饰）、麦曼诺（斯蒂芬•鲍尔文 饰）和杜学尼（凯文•波拉克
                                    饰），以及他本人，六个月前被警察局作为卡车抢劫案的疑犯带到警局过了一夜，五人因此结成了一个犯罪团伙，狼狈为奸，狠捞了好几笔。好景不长，某天，律师小林（皮特•波斯尔思韦特
                                    饰）找到他们，让他们替神秘头目凯撒•苏尔烧掉货轮上的毒品。法特第一个退出，随即遭到杀害，剩下四人不得不接受了这个任务。在货轮上，麦曼诺、法特、基顿都没有找到毒品，也因此相继被凯撒杀害，船也被炸毁，金特因为留在岸上接应而侥幸生还。
                                    　　另一边，在医院抢救的幸存者，拼出了凯撒的头像，结果让所有人大吃一惊……
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
                        <h2 class="title">绣春刀II：修罗战场 (2017)</h2>
                        <div class="content">
                            <img src="https://public.lightpic.info/image/D8B4_59A0FFF70.jpg" alt="">
                            <img src="https://public.lightpic.info/image/1521_59A0FE600.jpg" alt="">
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
