@extends('layouts-angel-mobile.app')

@section('head_attach')
    <link rel="stylesheet" href="/angel_mobile/guide/css/index.css" />
@endsection

@section('foot_attach')
@endsection

@section('content')
    <div class="g_BODY" id="g_BODY" style="opacity: 1;">
        @include('m.angel.aside.nav', ['user' => $me])
        <div class="header">
            <div class="h_tit bkg-white">
                <a href="javascript:history.back()" class="back_btn" id="back_btn"></a>
                <h1 class="c-black">이용안내</h1>
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
            @include('m.angel.aside.guide')
            <div class="g_title mg0">구매등록</div>
            <div class="guide_box">
                <ul>
                    <li>
                        <p class="fs-15 c-green">1 단계</p>
                        구매등록 선택
                    </li>
                    <li>
                        <p class="fs-15 c-green">2 단계</p>
                        구매정보입력
                        <em>
                            -게임/서버, 물품종류/수량<br>
                            -구매금액, 제목, 상세설명
                        </em>
                    </li>
                    <li>
                        <p class="fs-15 c-green">3 단계</p>
                        유료등록 서비스 선택
                    </li>
                    <li>
                        <p class="fs-15 c-green">4 단계</p>
                        구매등록 완료
                    </li>
                </ul>
            </div>

        </div>
        @include('m.angel.aside.footer')
    </div>
@endsection
