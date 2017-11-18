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
                <h4 class="title">
                    <a href="{{$current}}" target="_blank">{{$name}}</a>
                </h4>
                <div class="content taglist-cloud">
                    <?php
                    foreach ($list as $k => $v) {
                    ?>
                    <a href="{{$v['href']}}" target="_blank" title="{{$v['name']}}">{{$v['name']}}</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

@endsection
