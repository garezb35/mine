@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/angel/guide/css/index.css?v=210810">

    <script type="text/javascript" src="/angel/_banner/js/banner_module.js?v=210209"></script>
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
    </div>
@endsection
