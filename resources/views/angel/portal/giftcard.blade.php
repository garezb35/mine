@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/portal/giftcard/css/index.css?v=210617">
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/_js/_window_new.js?v=190220"></script>
    <script type="text/javascript" src="/angel/portal/giftcard/js/index.js?v=210617"></script>
@endsection

@section('content')
    <style>
        .aside .nav a {
            border-bottom: solid 1px gray;
            text-align: center;
        }
        .aside .nav > .nav_title {
            font-size: 16px;
            height: 50px;
            line-height: 50px;
            padding-left: 0px;
        }
    </style>
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        <div class="g_remocon_l"> </div>
        <script type="text/javascript">
            function serviceCert() {
                if(confirm('I-Pin(아이핀)을 이용하여 아이템천사에 가입하신 회원\n님들께서는 마일리지 충전 및 물품 거래 시 정상적인 이용\n을 위하여 최초 1회 이름 및 주민등록 번호로 본인 확인 절\n차를 거쳐야만 모든 기능을 사용하실 수 있습니다.\n인증을 하시겠습니까?')) {
                    location.href = '/portal/user/ipin_name_index';
                } else {
                    location.href = '/';
                }
            }
        </script>
        @include('aside.portal',['portal'=>$gift])

        <div class="g_content">
            <div class="top_area">
                <div class="big_bn">
                    <a href="/portal/giftcard/onestore/"><img src="/angel/_banner/sns_share_default.png" width="820" height="250" alt="원스토어" title="원스토어"></a>
                </div>
            </div>
            <div class="giftcard_list">
                <ul>
                    @foreach($gift_selected as $v)
                    <li class="active">
                        @if($v['new'] == 1)
                           <span class="ribbon param_ribon">new</span>
                        @endif
                        <a href="/portal/giftcard/{{$v['alias']}}"> <img src="{{$v['img']}}" width="160" height="120" alt="{{$v['name']}}" title="문화상품권"></a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
