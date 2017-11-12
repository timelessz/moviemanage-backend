{{--右侧的相关推荐--}}
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
            </div>
        </div>
    </div>
    <div class="container-fluid list-container list-middle-container">
        <div class="widget">
            <h4 class="title">博主推荐</h4>
            <div class="content movie-hot-list">
                <ul class="list-group">
                    <?php
                    foreach ($recommendmovie_list as $k=>$v){
                    ?>
                    <li class="list-group-item">
                        <a href="{{$v['href']}}" target="_blank" title="{{$v['title']}}">{{$k+1}} {{$v['name']}} &nbsp;&nbsp;
                            <?php if($k <= 2){?>
                            <i class="fa fa-fire" aria-hidden="true" style="color: #ffb508"></i>
                            <?php } ?>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid list-container list-middle-container">
        <div class="widget">
            <h4 class="title"><a href="/typelist.html" target="_blank">电影分类</a></h4>
            <div class="content tag-cloud">
                <?php
                foreach ($movietype as $k => $v) {
                if ($k <= 15) {
                ?>
                <a href="{{$v['href']}}" target="_blank" title="{{$v['name']}}">{{$v['name']}}</a>
                <?php
                } else {
                    break;
                }
                }
                ?>

                <a data-toggle="collapse" data-target="#collapseExample" aria-expanded="false"
                   aria-controls="collapseExample">
                    更多...
                </a>
                <div class="collapse" id="collapseExample">
                    <?php
                    foreach ($movietype as $k => $v) {
                    if ($k > 15 && $k < 40) {
                    ?>
                    <a href="{{$v['href']}}" target="_blank" title="{{$v['name']}}">{{$v['name']}}</a>
                    <?php
                    }else {
                        if ($k > 40) {
                            break;
                        }
                        continue;
                    }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid list-container list-middle-container">
        <div class="widget">
            <h4 class="title">电影杂谈</h4>
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
</div>
