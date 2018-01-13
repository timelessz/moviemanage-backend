@extends('app')

@section('breadcrumb')
    <div class="container">
        <ol class="breadcrumb">
            <?php
            foreach($breadcrumb as $k=>$v){
            ?>
            <li><a href="{{$v['href']}}" title="{{$v['title']}}">{{$v['text']}}</a></li>
            <?php
            }
            ?>
        </ol>
    </div>
@endsection

@section('content')
    <div class="col-lg-9 col-md-9 col-xs-12">
        <div class="container-fluid list-container">
            <div class="widget">
                <h1 class="title">{{$name}}</h1>
                <div class="container-fluid movie-list">
                    <div class="row">
                        <?php foreach ($movies as $v){ ?>
                        <div class="col-xs-6 col-md-4 col-lg-3" style="padding-left:8px;padding-right:8px;">
                            <div class="thumbnail" style="margin-bottom: 15px;margin-top: 0px">
                                <a href="{{$v['href']}}" title="{{$v['title']}}">
                                    <img src="{{$v['coversrc']}}" alt="{{$v['title']}}" title="{{$v['name']}}" style="height:240px">
                                </a>
                                <div class="row">
                                    <div class="col-lg-12 movie-list-title"
                                         style="width:100%;overflow:hidden;white-space:nowrap;text-overflow:ellipsis">
                                        <a href="{{$v['href']}}" title="{{$v['name']}}">
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
            <div class=" widget pull-right">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {!!$pagination !!} &nbsp;&nbsp;共{{$allpagenum}}页{{$count}}条
                    </ul>
                </nav>
            </div>
        </div>
    </div>

@endsection
