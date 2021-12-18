@extends('layouts-angel-mobile.app')

@section('head_attach')
@endsection

@section('foot_attach')
@endsection

@section('content')
    <div class="g_BODY" id="g_BODY" style="opacity: 1;">
        @include('m.angel.aside.nav', ['user' => $user])
        <div class="header">
            <div class="h_tit bkg-white">
                <a href="javascript:history.back()" class="back_btn" id="back_btn"></a>
                <h1 class="c-black">공지사항</h1>
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
            <div id="noticeList" class="swiper-container swiper-container-horizontal swiper-container-autoheight swiper-container-android">
                <div class="loading" style="display: none;"></div>
                <div class="swiper-wrapper" style="height: 500px; transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                    <div class="swiper-slide swiper-slide-active" data-hash="page1" style="width: 411px;">
                        <ul class="tb_list">
                            <li class="tb_head">
                                <div>제목</div>
                                <div>날짜</div>
                            </li>
                            <li>
                                <div class="cell_lt">[오픈] 블레이드 앤 소울 VS 아키에이지 업데이트 대항전&#xFEFF;</div>
                                <div>13-07-11</div>
                            </li>
                            <li class="detail_view"></li>
                            <li>
                                <div class="cell_lt">모바일 사이트 리뉴얼 안내</div>
                                <div>13-03-27</div>
                            </li>
                            <li class="detail_view"></li>
                            <li>
                                <div class="cell_lt">[오픈] 터치페이 충전 서비스 안내</div>
                                <div>12-12-05</div>
                            </li>
                            <li class="detail_view"></li>
                            <li>
                                <div class="cell_lt">디아블로3 득템 경매 게시판 오픈 안내</div>
                                <div>12-08-29</div>
                            </li>
                            <li class="detail_view"></li>
                        </ul>
                    </div>
                    <div class="swiper-slide swiper-slide-next" data-hash="page2" style="width: 411px;"></div>
                </div>
            </div>
            <script async="" src="//www.google-analytics.com/analytics.js"></script>

        </div>
        @include('m.angel.aside.footer')
    </div>
@endsection
