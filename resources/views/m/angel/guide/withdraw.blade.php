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
            <div class="g_title mg0">마일리지 출금</div>
            <div class="guide_box">
                <ul>
                    <li>
                        <p class="fs-15">1 단계</p>
                        마이룸<br>
                        내 마일리지 확인
                    </li>
                    <li>
                        <p class="fs-15">2 단계</p>
                        출금페이지 이동
                    </li>
                    <li>
                        <p class="fs-15">3 단계</p>
                        출금금액 입력
                    </li>
                    <li>
                        <p class="fs-15">4 단계</p>
                        출금완료
                    </li>
                </ul>
            </div>

        </div>
        @include('m.angel.aside.footer')
    </div>
@endsection
