@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/mileage/guide/css/charge.css">
@endsection

@section('foot_attach')
    <script type='text/javascript'>


    </script>
@endsection

@section('content')

<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    @include('angel.myroom.aside', ['group'=>'mileage', 'part'=>'charging'])
    <div class="g_content">
        <div class="g_title_blue"> 마일리지 충전
        </div>
        <div class="g_gray_border"></div>
        <ul class="g_big_box1">

        </ul>
        <div class="g_finish"></div>
        <div class="mile_info">
            <div class="top_info"> <img src="http://img4.itemmania.com/images/icon/icon_info.gif" width="69" height="69" alt="INFO 08"></div>
            <div class="g_no"> <img src="http://img2.itemmania.com/new_images/myroom/img_mileage.gif" width="816" height="74" alt="마일리지 충전 안내"> </div>
            <ul>
                <li class="title"> <img src="http://img3.itemmania.com/images/myroom/mileage/info01.gif" width="57" height="15" alt="무통장입금(전용계좌)"> </li>
                <li>고객님의 입금편의를 위해 전용 입금 계좌를 제공하고 있으며 계좌 발급 후 입금하시면 마일리지로 충전됩니다.
                    <br>모바일 사이트(m.itemmania.com)에서도 내 전용계좌 확인이 가능합니다.</li>
                <li class="line"></li>
                <li class="title"> <img src="http://img4.itemmania.com/images/myroom/mileage/info02.gif" width="155" height="15" alt="자동이체(실시간 계좌이체)"> </li>
                <li>고객님의 은행계좌에서 계좌정보 및 공인인증서 확인 후 바로 마일리지로 충전 가능합니다.</li>
                <li class="line"></li>
                <li class="title"> <img src="http://img2.itemmania.com/images/myroom/mileage/info03.gif" width="93" height="15" alt="전화결제(ARS)"> </li>
                <li>유선 일반전화기를 이용하여 마일리지를 충전하실 수 있습니다.</li>
                <li class="line"></li>
                <li class="title"> <img src="http://img4.itemmania.com/images/myroom/mileage/info05.gif" width="73" height="15" alt="상품권충전"> </li>
                <li>문화상품권, 스마트문화상품권, 도서문화, 해피머니 상품권으로 마일리지를 충전하실 수 있습니다.</li>
                <li class="line"></li>
                <li class="title"> <img src="http://img3.itemmania.com/images/myroom/mileage/info07.gif" width="84" height="15" alt="선불카드충전"> </li>
                <li>편의점 또는 문구점에서 판매되는 틴캐시, 에그머니, GP쿠폰 등으로 마일리지를 충전하실 수 있습니다.</li>
                <li class="line"></li>
                <li class="title"> <img src="http://img4.itemmania.com/images/myroom/mileage/info08.gif" width="101" height="15" alt="매니아전용충전"> </li>
                <li>M마일리지 이용권, 마일리지상품권 등 아이템천사와 제휴가 맺어진 상품권으로 마일리지를 충전하실 수 있습니다.</li>
            </ul>
        </div>
    </div>
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
