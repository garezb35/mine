@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/angel/portal/gamemeca/comm.css?v=210810">
@endsection

@section('foot_attach')
    <script type='text/javascript'>


    </script>
@endsection

@section('content')
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container " id="g_CONTENT">
        <div class="ct_cont mb-20">
            <div class="g_finish"></div>
            <div class="detail">
                <p class="title">{{$title}}</p>
                <em class="reporter">{{$subtitle}}</em>
                <em class="date">{{date('Y-m-d H:i:s',strtotime($created_at))}}</em>
            </div>
            <br>
            {!!$content!!}

        </div>
        <div class="right_ct">
            <div class="rg_tlt">
                많이 본 뉴스
                <a href="/news"><span class="more">더보기</span></a>
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

@endsection
