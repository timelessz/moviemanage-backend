<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../favicon.ico">
    <meta name="author" content="">
{!!$tdk_html!!}
<!--默认应该使用cdn的资源-->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <meta name="360-site-verification" content="c32173878cc2e7d571ecc1056481312e"/>
    <link rel="stylesheet" href="{{URL::asset('star/css/star-rating.css')}}" media="all" type="text/css"/>
    <link rel="stylesheet" href="{{URL::asset('dist/css/index.css')}}">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]>
    <script src="{{URL::asset('assets/js/ie8-responsive-file-warning.js')}}"></script>
    <![endif]-->
    <script src="{{URL::asset('assets/js/ie-emulation-modes-warning.js')}}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<script>
    (function () {
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
</script>
<script>(function(){
        var src = (document.location.protocol == "http:") ? "http://js.passport.qihucdn.com/11.0.1.js?cb130546e0e8aaffc7b3fa8261509715":"https://jspassport.ssl.qhimg.com/11.0.1.js?cb130546e0e8aaffc7b3fa8261509715";
        document.write('<script src="' + src + '" id="sozz"><\/script>');
    })();
</script>
<header class="main-header">
    <div class="container">
        <div class="row">
            <div class="index-top-logo col-lg-3 ">
                <img src="/image/logo.png" alt="电影下载2018，影窝电影" title="影窝电影网">
            </div>
            <div class="index-top-search col-lg-5 col-lg-offset-2">
                <div class="row searchinput">
                    <div class="6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="请输入　电影名、演员、电影类型">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">搜索</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="navbar-wrapper">
    <div class="container-fluid　nav">
        <!-- Fixed navbar -->
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?php
                        if($menu){
                        foreach ($menu as $k=>$v){
                        ?>
                        <li class="<?php if (array_key_exists('current', $v)) {
                            echo 'active';
                        } ?>"><a href="{{$v['path']}}" title="{{$v['title']}}">{{$v['text']}}</a></li>
                        <?php
                        }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="container  main-container">
    <div class="container  main-container">
        @yield('crousel')
        <div class="row">
            @yield('breadcrumb')
            @yield('content')
            @include('rightrecommend')
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('regionnewlist')
                @include('hotmovie')
            </div>
        </div>
    </div>
</div>

<footer class="main-footer list-middle-container">
    <div class="container container-footer ">
        <div class="row">
            <div class="col-sm-4">
                <div class="widget">
                    <h4 class="title"><a href="/yingping.html" target="_blank">电影影评</a></h4>
                    <div class="content recent-post">
                        <?php
                        //'footer_reviews', 'footer_tags', 'footer_types'
                        foreach($footer_reviews as $v){
                        ?>
                        <div class="recent-single-post">
                            <a href="{{$v['href']}}" class="post-title">{{$v['title']}}
                                <div class="date">{{$v['created_at']}}</div>
                            </a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="widget">
                    <h4 class="title">标签云</h4>
                    <div class="content tag-cloud">
                        <?php
                        foreach ($footer_tags as $v){
                        ?>
                        <a href="{{$v['href']}}" target="_blank">{{$v['name']}}</a>
                        <?php
                        }
                        ?>
                        <a href="/tag.html">...</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="widget">
                    <h4 class="title">电影分类</h4>
                    <div class="content tag-cloud friend-links">
                        <?php
                        foreach ($footer_types as $k=>$v){
                        if ($k % 6 == 1 && $k != 1) {
                            echo '<hr>';
                        }
                        ?>
                        <a href="{{$v['href']}}" title="{{$v['name']}}" target="_blank">{{$v['name']}}</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <span>
                    电影天堂电影下载网站 免费提供下载链接,本站不直接提供电影下载资源，所有电影下载 免费链接均来自网络，本站电影大多为rmvb格式，只供网络测试、请在下载电影24小时内删除所下内容，请支持购买正版！如无意中侵犯了您的权益,请发邮件至xlpuvip@126.com (使用时将#改为@),我们确认后将立即清除相关链接。
                 <a class="back-to-top" href="#top">
                    返回顶部
                 </a>
                </span>
                <hr>
                <span>
                    Copyright © <a href="http://www.dyxz2018.com/">电影下载主站 2016-2017</a>
               </span>
            </div>
        </div>
    </div>
</div>

<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>