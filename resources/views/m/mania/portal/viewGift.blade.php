@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/portal/giftcard/css/sub_index.css">
    <script type="text/javascript" src="/angel/_banner/js/banner_module.js"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/portal/banner/js/banner.js"></script>
    <script type="text/javascript" src="/angel/_js/_window_new.js"></script>
    <script type="text/javascript" src="/angel/portal/giftcard/js/common.js"></script>
@endsection
@section('content')

    <div class="g_container" id="g_CONTENT">
        <div class="g_remocon_l">
        </div>
        <script type="text/javascript">
            function serviceCert() {
                if (confirm('I-Pin(아이핀)을 이용하여 아이템천사에 가입하신 회원\n님들께서는 마일리지 충전 및 물품 거래 시 정상적인 이용\n을 위하여 최초 1회 이름 및 주민등록 번호로 본인 확인 절\n차를 거쳐야만 모든 기능을 사용하실 수 있습니다.\n인증을 하시겠습니까?')) {
                    location.href = '/portal/user/ipin_name_index.html';
                } else {
                    location.href = '/';
                }
            }
        </script>

        <form method="post" id="frm">
            <input type="hidden" name="code" value="418791970741de63073a73fc3fe93995">
        </form>
        @include('aside.portal',['portal'=>$gift])
        <div class="g_content">
            <div class="g_title noborder">
                구매하기
            </div>
            <div class="gray_box">
                <div class="img_area">
                    @if($hot == 1)
                    <div class="ribbon">
                        <img src="/angel/img/mall/hot.gif" width="47" height="47" alt="">
                    </div>
                    @endif
                    <img src="{{$thumnail}}" width="330" height="350" alt="">
                </div>
                <div class="gift_txt">
                    <div class="gift_txt_title">문화상품권 구매</div>
                    <div class="gift_txt_cont">{!! $description !!}</div>
                    <div class="gift_btn">
                        <a href="/portal/giftcard/giftcard_buy_list?pMode=O" class="btn-default btn-cancel">구매내역</a>
                        <a href="javascript:try{_window.open('Order_Pin', '{{$alias}}?pMode=O', 470, 780);}catch(e){}" class="btn-default btn-suc">구매하기</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
@endsection
