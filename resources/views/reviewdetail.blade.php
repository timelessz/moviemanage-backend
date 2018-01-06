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

        <div class="list-container container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h2 class="title">{{$moviereview['title']}}</h2>
                        <div class="content review-container">
                            {!!$moviereview['content'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php
        if ($relative_movie) {
        ?>
        <div class="list-container container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <h4 class="title">相关电影</h4>
                        <div class="content recent-post">

                            <div class="recent-single-post">
                                <a href="{{$relative_movie['href']}}" class="post-title" title="{{$relative_movie['title']}}">
                                    {{$relative_movie['title']}}
                                </a>
                                <div class="date pull-right">{{$relative_movie['created_at']}}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php
        }
        ?>
    </div>
@endsection
