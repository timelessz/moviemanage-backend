<div class="container-fluid list-container list-middle-container">
    <div class="widget">
        <h4 class="title">推荐</h4>
        <div class="content movie-hot-list">
            <ul class="list-group">
                <?php
                foreach ($recommendmovie_list as $k=>$v){
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