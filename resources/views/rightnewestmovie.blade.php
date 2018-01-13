{{--右侧的相关推荐--}}
<div class="col-lg-3 col-md-3 col-xs-12">
    <div class="container-fluid list-container">
        <div class="widget">
            <h4 class="title">最新更新</h4>
            <div class="content movie-hot-list">
                <ul class="list-group">
                    <?php
                    foreach ($allnewestmovie as $k=>$v){
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
</div>
