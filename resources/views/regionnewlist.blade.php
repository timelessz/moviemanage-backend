{{--四个地区的最新更新的电影 比如 欧美 日韩大陆 港台--}}
<div class="container-fluid list-container list-middle-container">
    <div data-example-id="togglable-tabs">
        <ul id="myTabs" class="nav nav-tabs" role="tablist">
            <?php
            foreach ($regionnewlist as $k=> $val) {
            ?>
            <li role="presentation" class="{{$k==0?'active':''}}">
                <a href="#{{$k}}" id="home-tab" role="tab" data-toggle="tab" aria-controls="{{$k}}"
                   aria-expanded="false" title="{{$v['title']}}">{{$val['name']}}</a>
            </li>
            <?php
            }
            ?>
        </ul>
        <div id="myTabContent" class="tab-content">
            <?php
            foreach ($regionnewlist as $key=> $val) {
            ?>
            <div role="tabpanel" class="tab-pane fade {{$key==0?'active in':''}}" id="{{$key}}"
                 aria-labelledby="home-tab">
                <div class="row">
                    <?php
                    foreach ($val['list'] as $k => $v) {
                    ?>
                    <div class="col-xs-6 col-md-4 col-lg-2" style="padding:5px;">
                        <div class="thumbnail" style="margin-bottom: 15px;margin-top: 0px">
                            <a href="{{$v['href']}}" title="{{$v['title']}}">
                                <img src="{{$v['coversrc']}}" alt="{{$v['title']}}" style="height:240px">
                            </a>
                            <div class="row">
                                <div class="col-lg-12 movie-list-title"
                                     style="width:100%;overflow:hidden;white-space:nowrap;text-overflow:ellipsis">
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
                                    {{$v['ages']}}
                                    <a href='{{$v['region']['href']}}' target="_blank">{{$v['region']['name']}}</a>
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
                    <?php } ?>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>






