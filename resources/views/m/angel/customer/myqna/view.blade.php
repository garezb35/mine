@extends('layouts-angel-mobile.app')

@section('head_attach')
    <link rel="stylesheet" href="/angel_mobile/customer/css/report.css" />
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
                <div class="g_title mg0">나의 1:1 상담내역</div>
                <div style="border: solid 1px #d1d1d1;">
                    <div class="head_part">상담분류</div>
                    <div class="content_part">
                        @switch ($askDetail['type'])
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
                    <div class="head_part">문의일자</div>
                    <div class="content_part">{{date('m-d H:i', strtotime($askDetail['created_at']))}}</div>
                    <div class="head_part">제목</div>
                    <div class="content_part">{{$askDetail['subject']}}</div>
                    <div class="head_part">내용</div>
                    <div class="content_part">
                        @if ($askDetail['content'] == "") {{$askDetail['subject']}}
                        @else {{$askDetail['content']}} @endif
                    </div>
                </div>
                <div class="g_title mg0">문의한 내용 답변보기</div>
                @if ($askDetail['response'] != '')
                    <div style="border: solid 1px #d1d1d1;">
                        <div class="head_part">처리상태</div>
                        <div class="content_part">처리완료</div>
                        <div class="head_part">답변일자</div>
                        <div class="content_part">11-15 23:54</div>
                        <div class="head_part">답변내용</div>
                        <div class="content_part">처리완료</div>
                        <div class="btn-groups_angel align-center">
                            <button class="btn-blue-img btn-color-img" type="submit">삭제</button>
                            <button class="btn-gray-img btn-color-img" type="button">목록</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @include('m.angel.aside.footer')
    </div>
@endsection
