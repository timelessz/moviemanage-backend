{{--四个地区的最新更新的电影 比如 欧美 日韩大陆 港台--}}
<div class="container-fluid">
    <div class="row">
        <?php
        foreach($regionnewlist as $val){
        ?>
        <div class="col-xs-6 col-md-3 col-lg-3 list-container list-middle-container">
            <div class="widget">
                <h4 class="title">
                    <a href="{{$val['href']}}" target="_blank" title="{{$val['title']}}">
                        {{$val['name']}}
                    </a>
                </h4>
                <div class="container-fluid movie-list">
                    <ul class="list-group">
                        <?php
                        foreach ($val['list'] as $k => $v) {
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
        <?php
        }
        ?>
    </div>
</div>




