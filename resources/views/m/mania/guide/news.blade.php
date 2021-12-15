@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/guide/css/index.css?v=210810">
@endsection

@section('foot_attach')
    <script type='text/javascript'>


    </script>
@endsection

@section('content')

    <div class="container_fulids " id="module-teaser-fullscreen">
        <div class="ct_cont mb-20">
            <div class="empty-high"></div>
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

@endsection
