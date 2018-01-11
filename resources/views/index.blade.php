@extends('app')
@section('breadcrumb')
    {{--面包屑--}}
@endsection
@section('crousel')
    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top: -10px">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php
            foreach ($fivecover_movie as $k => $v) {
            ?>
            <li data-target="#myCarousel" data-slide-to="{{$k}}" class="
            <?php echo $k == 0 ? 'active' : '';?>">
            </li>
            <?php
            }
            ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php
            foreach ($fivecover_movie as $k => $v) {
            ?>
            <div class="item <?php echo $k == 0 ? 'active' : '';?>">
                <a href="{{$v['href']}}" target="_blank" title="{{$v['title']}}">
                    <img class="first-slide" src="{{$v['big_coversrc']}}" alt="{{$v['title']}}">
                    <div class="container">
                        <div class="carousel-caption">
                            <div style="font-size:24px">{{$v['title']}}</div>
                            <p>
                                <?php
                                foreach ($v['type'] as $val) {
                                ?>
                                <span>
                                    {{$val['name']}}
                                </span>
                                <?php
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            }
            ?>
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div><!-- /.carousel -->
@endsection

@section('content')
    <div class="col-lg-9 col-md-9 col-xs-12">
        <div class="container-fluid list-container">
            <div class="widget">
                <h4 class="title">最新电影</h4>
                <div class="container-fluid movie-list">
                    <div class="row">
                        <?php foreach ($newest_movie as $v){ ?>
                        <div class="col-xs-6 col-md-4 col-lg-3" style="padding-left:8px;padding-right:8px;">
                            <div class="thumbnail" style="margin-bottom: 15px;margin-top: 0px">
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
            </div>
        </div>
    </div>
@endsection
