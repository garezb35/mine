@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_css/news.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/guide/css/index.css?v=210810">
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
                <li class="num{{$key+1}}"><a href="/news/view?seq={{$v['id']}}">{{$v['title']}}</a></li>
                @endforeach
                @endif
            </ul>
            <div class="rg_tlt rg_tlt2">
                인게게임순위
            </div>
            <ul class="fv_list2">
                <li class="num1">디아블로 2</li>
                <li class="num2">리그 오브 레전드</li>
                <li class="num3">로스트아크</li>
                <li class="num4">서든어택</li>
                <li class="num5">플레이어언노운스 배틀그라운드</li>
                <li class="num6">피파 온라인 4</li>
                <li class="num7">발로란트</li>
                <li class="num8">오버워치</li>
                <li class="num9">메이플스토리</li>
                <li class="num10">아이온: 영원의 탑</li>
            </ul>
        </div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection