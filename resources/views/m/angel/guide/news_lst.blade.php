@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/carsouel_plugin/css/carsouel_plugin.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/angel/portal/gamemeca/comm.css?v=210810">
@endsection

@section('foot_attach')
    <script type='text/javascript'>


    </script>
@endsection

@section('content')
    <div class="container_fulids ">
        <div class="container">
            <div class="ct_cont">
                @foreach($notices as $v)
                    <div class="list">
                        <a href="/news/view?seq={{$v['id']}}">{!! getImage($v['content']) !!}</a>
                        <div class="list_in">
                            <a href="/news/view?seq={{$v['id']}}">
                                <p class="title">{{$v['title']}}</p>
                                <p class="desc">{{$v['description']}}</p>
                            </a>
                            <em class="date">{{date("Y-m-d H:i:s",strtotime($v['created_at']))}}</em>
                        </div>
                    </div>
                @endforeach
                {{$notices->links()}}
            </div>
            <div class="right_ct">

                <div class="rg_tlt">
                    많이 본 뉴스
                </div>
                <ul class="fv_list">
                    @if(!empty($notice_list))
                        @foreach($notice_list as $key=>$v)
                            <li class="num"><span>{{$key+1}}</span><a href="/news/view?seq={{$v['id']}}">{{$v['title']}}</a></li>
                        @endforeach
                    @endif
                </ul>
                <div class="rg_tlt rg_tlt2">
                    인게게임순위
                </div>
                <ul class="fv_list2">
                    @foreach($game_list as $key=>$g)
                        <li class="num"><span>{{$key+1}}</span>{{$g['game']}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
