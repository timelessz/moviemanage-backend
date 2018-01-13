{{--底部相关的 八个最热电影--}}
<div class="container-fluid list-container list-middle-container">
    <div class="widget">
        <h4 class="title">热门电影</h4>
        <div class="container-fluid movie-list">
            <div class="row">
                <?php
                foreach ($hotmovie_list as $k=>$v){
                ?>
                <div class="col-xs-6 col-md-6 col-lg-2" style="padding-right:0px;">
                    <div class="thumbnail thumbnail-style" >
                        <a href="{{$v['href']}}" title="{{$v['title']}}">
                            <img src="{{$v['coversrc']}}" alt="{{$v['title']}}" style="height:240px">
                        </a>
                        <div class="row">
                            <div class="col-lg-12 movie-list-title">
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