@extends('layouts-mania.app')
@section('content')
<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="top_area">
    <div class="g_container">
        <ul class="tab">
            <li class="selected"><a href="/event/index.html">진행중인 이벤트</a></li>
            <li><a href="/event/event_close/index.html">종료된 이벤트</a></li>
        </ul>
        <ul class="g_path">
            <li>홈</li>
            <li>이벤트</li>
            <li class="selected">진행중인 이벤트</li>
        </ul>
    </div>
</div>
<div class="g_container">
    <ul class="e_category">
        <li class='on'> <a href="index.html?kind=000"><i class="SpGroup kind000"></i>전체</a> </li>
        <li> <a href="index.html?kind=001"><i class="SpGroup kind001"></i>서비스</a> </li>
        <li> <a href="index.html?kind=002"><i class="SpGroup kind002"></i>상품권</a> </li>
        <li> <a href="index.html?kind=003"><i class="SpGroup kind003"></i>게임</a> </li>
        <li> <a href="index.html?kind=004"><i class="SpGroup kind004"></i>충전/출금</a> </li>
        <li> <a href="index.html?kind=005"><i class="SpGroup kind005"></i>시즌</a> </li>
    </ul>
    <div class="event_wrap">
        <div class="e_box">
            <a href="/event/event_ing/game_invigoration_event/?event_id=e211008_diablo2"><img src="http://img.itemmania.com//event/banner/202110080921571633652517.7836.jpg" width="250" height="130" alt="디아2레저렉션 활성화 이벤트"></a>
            <br>
            <div class="title"> <i class='new'>new</i> <a href="/event/event_ing/game_invigoration_event/?event_id=e211008_diablo2">디아2레저렉션 활성화 이벤트</a> </div>
            <div class="descript">놀면 뭐하지? 디아블로2:레저렉션 해야지!
                <br /> 무조건 혜택받고 즐기세요!</div>
            <div class="date">기간 : 2021.10.08 ~ 2021.10.27</div>
        </div>
        <div class="e_box">
            <a href="/event/event_ing/reserve_event/?event_id=e211008_linW"><img src="http://img.itemmania.com//event/banner/202110061710121633507812.0622.jpg" width="250" height="130" alt="리니지w 사전예약 이벤트"></a>
            <br>
            <div class="title"> <i class='new'>new</i> <a href="/event/event_ing/reserve_event/?event_id=e211008_linW">리니지w 사전예약 이벤트</a> </div>
            <div class="descript">전세계가 연결된 리니지의 완성</div>
            <div class="date">기간 : 2021.10.08 ~ 2021.11.03</div>
        </div>
        <div class="e_box">
            <a href="/event/event_ing/e210901_simple_payment"><img src="http://img.itemmania.com//event/banner/202109011055431630461343.3159.jpg" width="250" height="130" alt="마일리지 간편결제 리뉴얼 이벤트"></a>
            <br>
            <div class="title"> <a href="/event/event_ing/e210901_simple_payment">마일리지 간편결제 리뉴얼 이벤트</a> </div>
            <div class="descript">안전하고 간편한 마일리지 간편결제!</div>
            <div class="date">기간 : 2021.09.01 ~ 2021.11.30</div>
        </div>
        <div class="e_box">
            <a href="/event/event_ing/e161012_mobile/"><img src="http://img.itemmania.com//event/banner/202011261609531606374593.9987.jpg" width="250" height="130" alt="매니아 아무~ 게임!"></a>
            <br>
            <div class="title"> <a href="/event/event_ing/e161012_mobile/">매니아 아무~ 게임!</a> </div>
            <div class="descript">솔직히 할거 없을땐 아무 게임이라도 해야지!</div>
            <div class="date">기간 : 2020.11.26 ~ </div>
        </div>
        <div class="e_box">
            <a href="/event/event_ing/e200908_naversmart_alarm/" target='_blank'><img src="http://img.itemmania.com//event/banner/202009100947131599698833.495.jpg" width="250" height="130" alt="네이버 스마트 알림톡 이벤트"></a>
            <br>
            <div class="title"> <a href="/event/event_ing/e200908_naversmart_alarm/" target='_blank'>네이버 스마트 알림톡 이벤트</a> </div>
            <div class="descript">네이버 스마트 알림톡 동의 받고
                <br /> 푸짐한 상품도 받자!!</div>
            <div class="date">기간 : 2020.09.10 ~ </div>
        </div>
        <div class="e_box">
            <a href="/event/event_ing/e200904_genie_toomics/"><img src="http://img.itemmania.com//event/banner/202101281106181611799578.1925.jpg" width="250" height="130" alt="투믹스 이용권 프로모션"></a>
            <br>
            <div class="title"> <a href="/event/event_ing/e200904_genie_toomics/">투믹스 이용권 프로모션</a> </div>
            <div class="descript">오직 아이템매니아 회원만!
                <br /> 쿠폰 & 마일리지 혜택까지 한번에!!</div>
            <div class="date">기간 : 2020.09.02 ~ </div>
        </div>
        <div class="e_box">
            <a href="/event/event_ing/e200604_join_firstbuy/" target='_blank'><img src="http://img.itemmania.com//event/banner/202006041739481591259988.757.jpg" width="250" height="130" alt="신규가입&첫구매이벤트"></a>
            <br>
            <div class="title"> <a href="/event/event_ing/e200604_join_firstbuy/" target='_blank'>신규가입&첫구매이벤트</a> </div>
            <div class="descript">신규가입 하고, 첫 구매하면 다~ 드리는 혜택!
                <br /> 할인쿠폰 최대 1만 2천원 지급! </div>
            <div class="date">기간 : 2020.06.04 ~ </div>
        </div>
        <div class="e_box">
            <a href="/event/event_ing/e190408_lotto/" target='_blank'><img src="http://img.itemmania.com//event/banner/201904151605201555311920.2825.jpg" width="250" height="130" alt="로또 추천번호 서비스"></a>
            <br>
            <div class="title"> <a href="/event/event_ing/e190408_lotto/" target='_blank'>로또 추천번호 서비스</a> </div>
            <div class="descript">로또 추천번호 오픈!
                <br /> 행운의 예측번호 무료지급!</div>
            <div class="date">기간 : 2019.04.15 ~ </div>
        </div>
        <div class="e_box">
            <a href="/event/event_ing/e190417_attend/" target='_blank'><img src="http://img.itemmania.com//event/banner/202109011051141630461074.2981.jpg" width="250" height="130" alt="통합 출석 이벤트"></a>
            <br>
            <div class="title"> <a href="/event/event_ing/e190417_attend/" target='_blank'>통합 출석 이벤트</a> </div>
            <div class="descript">매일매일 출석하고 당첨 확인!
                <br /> 100% 출석하면 문화상품권 즉시 지급!</div>
            <div class="date">기간 : 2018.04.02 ~ </div>
        </div>
        <div class="e_box">
            <a href="/event/event_ing/e160414_comeback/" target='_blank'><img src="http://img.itemmania.com//event/banner/201902210652101550699530.1265.jpg" width="250" height="130" alt="휴면고객 혜택 이벤트"></a>
            <br>
            <div class="title"> <a href="/event/event_ing/e160414_comeback/" target='_blank'>휴면고객 혜택 이벤트</a> </div>
            <div class="descript">오랜만이에요~ 어디 갔다 이제 왔어요!!
                <br /> 꽝 없는 당첨박스 그냥 지나치지 마세요~!!</div>
            <div class="date">기간 : 2016.04.14 ~ </div>
        </div>
    </div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
