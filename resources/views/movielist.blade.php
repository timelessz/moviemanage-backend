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
                    <?php
                    foreach ($movies as $k=>$v){
                    ?>
                    <div class="media movie-list-item">
                        <div class="media-left">
                            <a href="{{$v['href']}}" title="{{$v['title']}}">
                                <img class="media-object" data-src="holder.js/90x90" alt="{{$v['title']}}"
                                     src="{{$v['coversrc']}}"
                                     data-holder-rendered="true" style="width:90px;">
                            </a>
                        </div>
                        <div class="media-body">
                            <div>
                                <h2 class="media-heading" style="font-size:24px;display: inline-block">
                                    <a href="{{$v['href']}}" target="_blank">{{$v['name']}}</a>
                                </h2>
                                <span class="doubanscore"> {{$v['doubanscore']}}</span>
                            </div>
                            <p>
                                <a href="{{$v['href']}}" target="_blank"
                                   title="{{$v['summary']}}"> {{$v['sub_summary']}}
                                </a>
                            </p>
                            <div class="pull-left">
                                <span>
                                    <a href="{{$current}}" target="_blank">{{$v['region_name']}}</a>
                                </span>
                                <span>
                                    <?php
                                    foreach ($v['type'] as $val) {
                                    ?>
                                    <a href='{{$val['href']}}' target="_blank">{{$val['name']}}</a>
                                    <?php
                                    }
                                    ?></span>
                            </div>
                            <div class="pull-right">
                                {{$v['created_at']}}
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
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
