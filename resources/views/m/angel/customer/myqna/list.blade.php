@extends('layouts-angel-mobile.app')

@section('head_attach')
    <link rel="stylesheet" href="/angel_mobile/customer/css/ask.css" />
    <style>
        .tb_list {
            border: 1px solid #d5d5d5 !important;
        }
    </style>
@endsection

@section('foot_attach')

@endsection

@section('content')
    <div class="g_BODY" id="g_BODY" style="opacity: 1;">
        @include('m.angel.aside.nav', ['user' => $me])
        <div class="header">
            <div class="h_tit bkg-white">
                <a href="javascript:history.back()" class="back_btn" id="back_btn"></a>
                <h1 class="c-black">나의 질문과 답변</h1>
                <button class="btn_menu" id="btn_menu"><em>메뉴</em></button>
            </div>
        </div>
        <div class="container">
            @php
                $isLogined = '';
                if (Auth::check()) {
                    $isLogined = 1;
                }
            @endphp
            <input id="_LOGINCHECK" type="hidden" value="{{$isLogined}}">
            <div class="content">
                <div class="g_title mg0">나의 질문과 답변</div>
                <form name="signForm" id="signForm" method="post">
                    <ul class="tb_list">
                        <li class="tb_head">
                            <div>문의유형</div>
                            <div>제목</div>
                            <div>처리상황</div>
                            <div>등록일자</div>
                        </li>
                        @foreach ($askRecord as $rec)
                        <li>
                            <div>
                                @switch ($rec['type'])
                                    @case ('cancel')
                                    취소요청
                                    @break;
                                    @case ('complete')
                                    종료요청
                                    @break;
                                    @case ('login')
                                    로그인문의
                                    @break;
                                    @case ('charge')
                                    충전/입금문의
                                    @break;
                                    @case ('exchange')
                                    출금문의
                                    @break;
                                    @case ('other')
                                    기타문의
                                    @break;
                                    @case ('faulty')
                                    비거래 물품 신고
                                    @break;
                                    @case ('newgame')
                                    신규게임/서버 추가
                                    @break;
                                @endswitch
                            </div>
                            <div class="ellips">
                                <a href="/customer/myqna/view?seq={{$rec['askid']}}">{{$rec['subject']}}</a>
                            </div>
                            <div>{{$rec['response'] == '' ? '답변 대기' : '답변 완료'}}</div>
                            <div>{{date('m-d H:i', strtotime($rec['created_at']))}}</div>
                        </li>
                        @endforeach
                    </ul>
                </form>
            </div>
        </div>
        @include('m.angel.aside.footer')
    </div>
@endsection
