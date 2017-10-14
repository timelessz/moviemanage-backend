@extends('app')
@section('title', 'Page Title')
@section('description', 'Page Title')
@section('keywords', 'Page Title')
@section('menu')
    <li class="active"><a href="#">首页</a></li>
    <li><a href="#about">欧美电影</a></li>
    <li><a href="#contact">大陆电影</a></li>
    <li><a href="#contact">日韩电影</a></li>
    <li><a href="#contact">港台电影</a></li>
    <li><a href="#contact">博主推荐</a></li>
    <li><a href="#contact">电影影评</a></li>
@endsection

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">首页</a></li>
            <li><a href="#">欧美电影</a></li>
        </ol>
    </div>
    <div class="container  main-container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-xs-12">
                <div class="container-fluid list-container">
                    <div class="widget">
                        <h1 class="title">欧美电影</h1>
                        <div class="container-fluid movie-list">
                            <div class="media movie-list-item">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" data-src="holder.js/64x64" alt="64x64"
                                             src="image/demo1.jpg"
                                             data-holder-rendered="true" style="width: 64px; height: 89px;">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">台北物语</h4>
                                    <p>
                                        明天启七年，北镇抚司锦衣卫沈炼（张震 饰）在一次扫除乱党任务中，为救画师北斋（杨幂 饰），将同僚凌云铠（武强 饰）灭口。此后一方面要摆脱来自陆文昭（张译
                                        饰）、裴纶（雷佳音
                                        饰）的质疑与调查，一方面又在神秘女子的要挟下放火烧了锦衣卫经历司。裹挟在乱世，沈炼与北斋情陷其中，却越陷越深。
                                    </p>
                                    <p>日期：2017年9月28日</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" data-src="holder.js/64x64" alt="64x64"
                                             src="image/demo1.jpg"
                                             data-holder-rendered="true" style="width: 64px; height: 89px;">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Top aligned media</h4>
                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                        sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus
                                        viverra
                                        turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue
                                        felis in faucibus.</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" data-src="holder.js/64x64" alt="64x64"
                                             src="image/demo1.jpg"
                                             data-holder-rendered="true" style="width: 64px; height: 89px;">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Top aligned media</h4>
                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                        sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus
                                        viverra
                                        turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue
                                        felis in faucibus.</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" data-src="holder.js/64x64" alt="64x64"
                                             src="image/demo1.jpg"
                                             data-holder-rendered="true" style="width: 64px; height: 89px;">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Top aligned media</h4>
                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                        sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus
                                        viverra
                                        turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue
                                        felis in faucibus.</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" data-src="holder.js/64x64" alt="64x64"
                                             src="image/demo1.jpg"
                                             data-holder-rendered="true" style="width: 64px; height: 89px;">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Top aligned media</h4>
                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                        sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus
                                        viverra
                                        turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue
                                        felis in faucibus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-md-4 col-lg-4 list-container list-middle-container">
                            <div class="widget">
                                <h4 class="title">欧美</h4>
                                <div class="container-fluid movie-list">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <a href="">1 超凡战队 &nbsp;&nbsp;
                                                <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="">
                                                2 龙骑侠&nbsp;&nbsp;
                                                <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="">3 秦香莲&nbsp;&nbsp;
                                                <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                                            </a>
                                        </li>
                                        <li class="list-group-item"><a href="">4 临时演员</a></li>
                                        <li class="list-group-item"><a href="">5 我的爸爸是国王</a></li>
                                        <li class="list-group-item"><a href="">6 明天也有好吃的饭菜</a></li>
                                        <li class="list-group-item"><a href="">7 国境线</a></li>
                                        <li class="list-group-item"><a href="">8 奇迹那天如此重要</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4 col-lg-4 list-container list-middle-container">
                            <div class="widget">
                                <h4 class="title">大陆</h4>
                                <div class="container-fluid movie-list">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <a href="">1 超凡战队 &nbsp;&nbsp;
                                                <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="">
                                                2 龙骑侠&nbsp;&nbsp;
                                                <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="">3 秦香莲&nbsp;&nbsp;
                                                <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                                            </a>
                                        </li>
                                        <li class="list-group-item"><a href="">4 临时演员</a></li>
                                        <li class="list-group-item"><a href="">5 我的爸爸是国王</a></li>
                                        <li class="list-group-item"><a href="">6 明天也有好吃的饭菜</a></li>
                                        <li class="list-group-item"><a href="">7 国境线</a></li>
                                        <li class="list-group-item"><a href="">8 奇迹那天如此重要</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4 col-lg-4 list-container list-middle-container">
                            <div class="widget">
                                <h4 class="title">日韩</h4>
                                <div class="container-fluid movie-list">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <a href="">1 超凡战队 &nbsp;&nbsp;
                                                <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="">
                                                2 龙骑侠&nbsp;&nbsp;
                                                <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="">3 秦香莲&nbsp;&nbsp;
                                                <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                                            </a>
                                        </li>
                                        <li class="list-group-item"><a href="">4 临时演员</a></li>
                                        <li class="list-group-item"><a href="">5 我的爸爸是国王</a></li>
                                        <li class="list-group-item"><a href="">6 明天也有好吃的饭菜</a></li>
                                        <li class="list-group-item"><a href="">7 国境线</a></li>
                                        <li class="list-group-item"><a href="">8 奇迹那天如此重要</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid list-container list-middle-container">
                    <div class="widget">
                        <h4 class="title">热门电影</h4>
                        <div class="container-fluid movie-list">
                            <div class="row">
                                <div class="col-xs-6 col-md-3 col-lg-3">
                                    <a href="#" class="thumbnail">
                                        <img src="image/demo.jpg" alt="欧美电影">
                                        <div class="row">
                                            <div class="col-lg-12 movie-list-title">国境线</div>
                                        </div>
                                        <div class="row" style="padding-left: 15px">
                                            <input class="input-21c" value="8.4" type="text"
                                                   data-default-caption="{rating} 分" title="" class="rating">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-6 col-md-3 col-lg-3">
                                    <a href="#" class="thumbnail">
                                        <img src="image/demo1.jpg" alt="欧美电影">
                                        <div class="row">
                                            <div class="col-lg-12 movie-list-title" title="2017年8月12日">台北物语</div>
                                        </div>
                                        <div class="row" style="padding-left: 15px">
                                            <input class="input-21c" value="6.7" type="text"
                                                   data-default-caption="{rating} 分" title="" class="rating">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-6 col-md-3 col-lg-3">
                                    <a href="#" class="thumbnail">
                                        <img src="image/head-bg.jpg" alt="欧美电影">
                                        <div class="row">
                                            <div class="col-lg-12 movie-list-title">战狼2</div>
                                        </div>
                                        <div class="row" style="padding-left: 15px">
                                            <input class="input-21c" value="5.3" type="text"
                                                   data-default-caption="{rating} 分" title="" class="rating">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-6 col-md-3 col-lg-3">
                                    <a href="#" class="thumbnail">
                                        <img src="image/head-bg.jpg" alt="欧美电影">
                                        <div class="row">
                                            <div class="col-lg-12 movie-list-title">战狼2</div>
                                        </div>
                                        <div class="row" style="padding-left: 15px">
                                            <input class="input-21c" value="2.3" type="text"
                                                   data-default-caption="{rating} 分" title="" class="rating">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-md-3 col-lg-3">
                                    <a href="#" class="thumbnail">
                                        <img src="image/demo.jpg" alt="欧美电影">
                                        <div class="row">
                                            <div class="col-lg-12 movie-list-title">国境线</div>
                                        </div>
                                        <div class="row" style="padding-left: 15px">
                                            <input class="input-21c" value="8.4" type="text"
                                                   data-default-caption="{rating} 分" title="" class="rating">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-6 col-md-3 col-lg-3">
                                    <a href="#" class="thumbnail">
                                        <img src="image/demo1.jpg" alt="欧美电影">
                                        <div class="row">
                                            <div class="col-lg-12 movie-list-title" title="2017年8月12日">台北物语</div>
                                        </div>
                                        <div class="row" style="padding-left: 15px">
                                            <input class="input-21c" value="6.7" type="text"
                                                   data-default-caption="{rating} 分" title="" class="rating">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-6 col-md-3 col-lg-3">
                                    <a href="#" class="thumbnail">
                                        <img src="image/head-bg.jpg" alt="欧美电影">
                                        <div class="row">
                                            <div class="col-lg-12 movie-list-title">战狼2</div>
                                        </div>
                                        <div class="row" style="padding-left: 15px">
                                            <input class="input-21c" value="5.3" type="text"
                                                   data-default-caption="{rating} 分" title="" class="rating">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-6 col-md-3 col-lg-3">
                                    <a href="#" class="thumbnail">
                                        <img src="image/head-bg.jpg" alt="欧美电影">
                                        <div class="row">
                                            <div class="col-lg-12 movie-list-title">战狼2</div>
                                        </div>
                                        <div class="row" style="padding-left: 15px">
                                            <input class="input-21c" value="2.3" type="text"
                                                   data-default-caption="{rating} 分" title="" class="rating">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-xs-12">
                <div class="container-fluid list-container">
                    <div class="widget">
                        <h4 class="title">热门搜索</h4>
                        <div class="content tag-cloud">
                            <a href="/tag/jquery/">jQuery</a>
                            <a href="/tag/ghost-0-7-ban-ben/">Ghost 0.7 版本</a>
                            <a href="/tag/opensource/">开源</a>
                            <a href="/tag/zhu-shou-han-shu/">助手函数</a>
                            <a href="/tag/tag-cloud/">标签云</a>
                            <a href="/tag/navigation/">导航</a>
                            <a href="/tag/customize-page/">自定义页面</a>
                            <a href="/tag/static-page/">静态页面</a>
                            <a href="/tag/roon-io/">Roon.io</a>
                            <a href="/tag/release/">新版本发布</a>
                            <a href="/tag-cloud/">...</a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid list-container list-middle-container">
                    <div class="widget">
                        <h4 class="title">热映</h4>
                        <div class="content movie-hot-list">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="">1 超凡战队 &nbsp;&nbsp;
                                        <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="">
                                        2 龙骑侠&nbsp;&nbsp;
                                        <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="">3 秦香莲&nbsp;&nbsp;
                                        <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                                    </a>
                                </li>
                                <li class="list-group-item"><a href="">4 临时演员</a></li>
                                <li class="list-group-item"><a href="">5 我的爸爸是国王</a></li>
                                <li class="list-group-item"><a href="">6 明天也有好吃的饭菜</a></li>
                                <li class="list-group-item"><a href="">7 国境线</a></li>
                                <li class="list-group-item"><a href="">8 奇迹那天如此重要</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="container-fluid list-container list-middle-container">
                    <div class="widget">
                        <h4 class="title">最新更新</h4>
                        <div class="content movie-hot-list">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="">1 超凡战队 &nbsp;&nbsp;
                                        <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="">
                                        2 龙骑侠&nbsp;&nbsp;
                                        <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="">3 秦香莲&nbsp;&nbsp;
                                        <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                                    </a>
                                </li>
                                <li class="list-group-item"><a href="">4 临时演员</a></li>
                                <li class="list-group-item"><a href="">5 我的爸爸是国王</a></li>
                                <li class="list-group-item"><a href="">6 明天也有好吃的饭菜</a></li>
                                <li class="list-group-item"><a href="">7 国境线</a></li>
                                <li class="list-group-item"><a href="">8 奇迹那天如此重要</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="container-fluid list-container list-middle-container">
                    <div class="widget">
                        <h4 class="title">电影分类</h4>
                        <div class="content tag-cloud">
                            <a href="/tag/jquery/">爱情</a>
                            <a href="/tag/ghost-0-7-ban-ben/">动作</a>
                            <a href="/tag/opensource/">喜剧</a>
                            <a href="/tag/zhu-shou-han-shu/">科幻</a>
                            <a href="/tag/tag-cloud/">文艺</a>
                            <a href="/tag/tag-cloud/">恐怖</a>
                            <a href="/tag/tag-cloud/">动画</a>
                            <a href="/tag/tag-cloud/">经典</a>
                            <a href="/tag/tag-cloud/">欧美</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
