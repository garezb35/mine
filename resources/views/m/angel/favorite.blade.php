@extends('layouts-angel-mobile.app')

@section('head_attach')
    <link rel="stylesheet" href="/angel_mobile/favorite/css/index.css" />
@endsection

@section('foot_attach')
    <script src="/angel_mobile/favorite/js/index.js"></script>
@endsection

@section('content')
    <div class="e4rn34RT" id="e4rn34RT">
        <div class="mk78F_ret" id="mk78F_ret"></div>
        <div class="mk78F_ret preview_ife" id="preview_ife">
            <div class="loading_wrap">
                <div class="loading_ct"> <img src="/angel_mobile/img/icon/spinning-loading.gif" width="100" height="100" alt="loading">
                    <br> <span id="loading_txt"></span>
                </div>
            </div>
        </div>
        <input type="hidden" id="web_check" value="w">
        <div class="container">
            <input type="hidden" id="_LOGINCHECK" value="1">
            <div>
                <h4 class="bookmark_page_title">즐겨찾는 서비스</h4>
                <span class="back_btn" id="back_btn"></span>
            </div>
            <div class="content">
                <div id="bookmark_icon_list_title_wrapper" class="clear_fix">
                    <h6>
                        즐겨찾는 서비스를 선택하세요
                    </h6>
                </div>
                <div class="bookmark_guide_wrap">
                    <div class="bookmark_guide">
                        <div class="bookmark_guide_right"> [즐겨찾기는 최대 7개까지 설정 가능합니다.] </div>
                    </div>
                </div>
                <div class="bookmark_icon_list_wrapper clear_fix">
                    <ul class="bookmark_icon_list">
                        <li class="bookmark on" data-seq="1">
                            <div class="bookmark_set"> <span class="bookmark_icon regSell  on"></span> <span class="bookmark_title">판매등록</span> </div>
                        </li>
                        <li class="bookmark on" data-seq="2">
                            <div class="bookmark_set"> <span class="bookmark_icon regBuy  on"></span> <span class="bookmark_title">구매등록</span> </div>
                        </li>
                        <li class="bookmark on" data-seq="3">
                            <div class="bookmark_set"> <span class="bookmark_icon selling  on"></span> <span class="bookmark_title">판매중</span> </div>
                        </li>
                        <li class="bookmark on" data-seq="4">
                            <div class="bookmark_set"> <span class="bookmark_icon buying  on"></span> <span class="bookmark_title">구매중</span> </div>
                        </li>
                        <li class="bookmark on" data-seq="5">
                            <div class="bookmark_set"> <span class="bookmark_icon charge  on"></span> <span class="bookmark_title">충전</span> </div>
                        </li>
                        <li class="bookmark on" data-seq="6">
                            <div class="bookmark_set"> <span class="bookmark_icon payment  on"></span> <span class="bookmark_title">출금</span> </div>
                        </li>
                        <li class="bookmark on" data-seq="7">
                            <div class="bookmark_set"> <span class="bookmark_icon mileage  on"></span> <span class="bookmark_title">마일리지</span> </div>
                        </li>
                        <li class="bookmark" data-seq="8">
                            <div class="bookmark_set"> <span class="bookmark_icon myroom "></span> <span class="bookmark_title">마이룸</span> </div>
                        </li>
                        <li class="bookmark" data-seq="9">
                            <div class="bookmark_set"> <span class="bookmark_icon giftmall "></span> <span class="bookmark_title">상품권몰</span> </div>
                        </li>
                        <li class="bookmark" data-seq="10">
                            <div class="bookmark_set"> <span class="bookmark_icon message "></span> <span class="bookmark_title">메시지함</span> </div>
                        </li>
                        <li class="bookmark" data-seq="11">
                            <div class="bookmark_set"> <span class="bookmark_icon spoint "></span> <span class="bookmark_title">쇼핑포인트</span> </div>
                        </li>
                        <li class="bookmark" data-seq="12">
                            <div class="bookmark_set"> <span class="bookmark_icon eventMenu "></span> <span class="bookmark_title">이벤트</span> </div>
                        </li>
                    </ul>
                </div>
                <div class="btn_wrap">
                    <button id="save_btn" data-enabled="true">저장</button>
                </div>
            </div>
        </div>
        @include('m.angel.aside.footer')
    </div>
@endsection
