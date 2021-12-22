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
            <div class="g_title mg0">판매하기</div>
            <div class="guide_box">
                <ul>
                    <li>
                        <p class="fs-15">1 단계</p>
                        판매할 물품 검색 및 선택
                    </li>
                    <li>
                        <p class="fs-15">2 단계</p>
                        판매물품 입금확인
                    </li>
                    <li>
                        <p class="fs-15">3 단계</p>
                        구매자 정보확인<br>
                        물품전달/인계확인
                    </li>
                    <li>
                        <p class="fs-15">4 단계</p>
                        판매종료
                    </li>
                </ul>
            </div>
            {{--            <dl class="g_subtxt">--}}
            {{--                <dt>알아두기</dt>--}}
            {{--                <dd>- 판매 등록 시 본인정보(게임/서버/캐릭터명)를 등록 하세요.</dd>--}}
            {{--                <dd>- 등록물품의 문제가 발생할때 민/형사상 책임은 물품 등록자에게 있습니다.</dd>--}}
            {{--                <dd>- 유료 서비스를 이용할 경우 물품리스트 상단에 노출 됩니다.</dd>--}}
            {{--            </dl>--}}
        </div>
        @include('m.angel.aside.footer')
    </div>
@endsection
