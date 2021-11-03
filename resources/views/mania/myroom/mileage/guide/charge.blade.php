@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/mileage/guide/css/charge.css?v=210602">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type='text/javascript'>
        var gsVersion = '2110141801';
        var _LOGINCHECK = '1';
    </script>
@endsection

@section('content')

<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    @include('mania.myroom.aside', ['group'=>'mileage', 'part'=>'charging'])
    <div class="g_content">
        <div class="g_title_blue"> 마일리지 충전
            <ul class="g_path">
                <li>홈</li>
                <li>마이룸</li>
                <li>마일리지</li>
                <li class="select">마일리지 충전</li>
            </ul>
        </div>
        <div class="g_gray_border"></div>
        <ul class="g_big_box1">
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/tcash.html', 701, 900);">TCash 충전<span class="img_charge28">TCash 충전</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/ktclip.html', 701, 900);">카드포인트
                <div class="icon_new"></div><span class="img_charge34">카드포인트</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/creditcard.html', 701, 900);">신용카드 충전<span class="img_charge01">신용카드 충전</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/phone_ars.html', 701, 900);">휴대폰 ARS충전<span class="img_charge06">휴대폰 ARS충전</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/realaccount.html', 701, 900);">자동이체<span class="img_charge11">자동이체</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/ars.html', 701, 900);">전화결제(ARS)<span class="img_charge16">전화결제(ARS)</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/onlyculture.html', 701, 900);">문화상품권<span class="img_charge02">문화상품권</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/teencash.html', 701, 900);">틴캐시<span class="img_charge12">틴캐시</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/pointpark.html', 701, 900);">포인트충전<span class="img_charge22">포인트충전</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/bookgift.html', 701, 900);">도서문화 상품권<span class="img_charge03">도서문화 상품권</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/eggmoney.html', 701, 900);">에그머니<span class="img_charge13">에그머니</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/mybank.html', 701, 900);">내통장결제<span class="img_charge38">내통장결제</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/gpgw.html', 701, 900);">GP쿠폰<span class="img_charge23">GP쿠폰</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/onlyhpmn.html', 701, 900);">해피머니상품권<span class="img_charge04">해피머니상품권</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/tmoney.html', 701, 900);">모바일티머니<span class="img_charge09">모바일티머니</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/maniacoupon.html', 701, 900);">매니아 선불쿠폰<span class="img_charge19">매니아 선불쿠폰</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/coupon.html', 701, 900);">이벤트쿠폰<span class="img_charge24">이벤트쿠폰</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/onlydgcl.html', 701, 900);">스마트문상(게임문상)<span class="img_charge05">스마트문상(게임문상)</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/cashbee.html', 701, 900);">모바일캐시비<span class="img_charge10">모바일캐시비</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/cashgate.html', 701, 900);">캐시플러스<span class="img_charge15">캐시플러스</span></li>
            <li onclick="window.open('/portal/maniaplay/free/index.html');">무료충전소<span class="img_charge25">무료충전소</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/mileage.html', 701, 900);">마일리지 상품권<span class="img_charge26">마일리지 상품권</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/index.html', 701, 900);">전용계좌<span class="img_charge21">전용계좌</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/mmileage.html', 701, 900);">M마일리지 이용권<span class="img_charge30">M마일리지 이용권</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/im_gift.html', 701, 900);">IM기프트 상품권<span class="img_charge31">IM기프트 상품권</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/mobilepop.html', 701, 900);">모바일팝<span class="img_charge32">모바일팝</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/moneytree.html', 701, 900);">머니트리<span class="img_charge33">머니트리</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/pipe.html', 701, 900);">암호화폐 충전<span class="img_charge35">암호화폐 충전</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/paycoin.html', 701, 900);">페이코인 충전<span class="img_charge36">페이코인 충전</span></li>
            <li onclick="_window.open('mileage_charge', '/myroom/mileage/charge/kbank.html', 701, 900);">케이뱅크 페이<span class="img_charge37">케이뱅크 페이</span></li>
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
                <!--			<li class="title"><img src="-->
                <!--/images/myroom/mileage/info06.gif" width="73" height="15" alt="편의점충전"></li>-->
                <!--			<li>가맹 편의점에서 아이템매니아 캐쉬를 구입 후 영수증에 기재된 일련번호를 입력하면 즉시 마일리지로 충전할 수 있습니다.</li>-->
                <!--			<li class="line"></li>-->
                <li class="title"> <img src="http://img3.itemmania.com/images/myroom/mileage/info07.gif" width="84" height="15" alt="선불카드충전"> </li>
                <li>편의점 또는 문구점에서 판매되는 틴캐시, 에그머니, GP쿠폰 등으로 마일리지를 충전하실 수 있습니다.</li>
                <li class="line"></li>
                <li class="title"> <img src="http://img4.itemmania.com/images/myroom/mileage/info08.gif" width="101" height="15" alt="매니아전용충전"> </li>
                <li>M마일리지 이용권, 마일리지상품권 등 아이템매니아와 제휴가 맺어진 상품권으로 마일리지를 충전하실 수 있습니다.</li>
            </ul>
        </div>
    </div>
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
