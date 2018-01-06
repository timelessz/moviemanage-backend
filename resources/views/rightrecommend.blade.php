{{--右侧的相关推荐--}}
<div class="col-lg-3 col-md-3 col-xs-12">
    <div class="container-fluid list-container">
        <div class="widget">
            <h4 class="title">热门搜索</h4>
            <div class="content tag-cloud">
                <a href="/">豆瓣高分</a>
                <a href="/">战狼2</a>
                <a href="/">热映</a>
                <a href="/">速度与激情</a>
                <a href="/">天才枪手</a>
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
            <h4 class="title">
                <a href="/typelist.html" target="_blank">电影分类</a>
            </h4>
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
            <h4 class="title">电影资讯</h4>
            <div class="content movie-hot-list">
                <ul class="list-group">
                    <?php
//                    print_r($reviewlist);
                    foreach ($reviewlist as $k=>$v){
                    ?>
                    <li class="list-group-item">
                        <a href="{{$v['href']}}" target="_blank" title="{{$v['title']}}">{{$k+1}} {{$v['title']}} &nbsp;&nbsp;
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
</div>
