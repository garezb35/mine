@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/portal/gamemeca/comm.css?v=210810">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type='text/javascript'>
        var gsVersion = '2110141801';
        var _LOGINCHECK = '1';
    </script>
@endsection

@section('content')
    <div class="g_container ">
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
                            <li class="num{{$key+1}}"><a href="/news/view?seq={{$v['id']}}">{{$v['title']}}</a></li>
                        @endforeach
                    @endif
                </ul>
                <div class="rg_tlt rg_tlt2">
                    인게게임순위
                </div>
                <ul class="fv_list2">
                    @foreach($game_list as $key=>$g)
                        <li class="num{{$key+1}}">{{$g['game']}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
