<div class="col-lg-12">
    <div class="container-fluid list-container list-middle-container">
        <div class="widget">
            <h4 class="title">
                <a href="/typelist.html" target="_blank">电影分类</a>
            </h4>
            <div class="content taglist-cloud">
                <?php
                foreach ($movietype as $k => $v) {
                if ($k <= 10) {
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
                    if ($k > 10) {
                    ?>
                    <a href="{{$v['href']}}" target="_blank" title="{{$v['name']}}">{{$v['name']}}</a>
                    <?php
                    }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>