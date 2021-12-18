<div class="g_MASK" id="g_MASK"></div>
<div class="g_MASK g_LOADING" id="g_LOADING">
    <div class="loading_wrap">
        <div class="loading_ct"> <img src="/angel_mobile/img/icon/spinning-loading.gif" width="100" height="100" alt="loading">
            <br> <span id="loading_txt"></span>
        </div>
    </div>
</div>
<div id="h_menu" class="h_menu">
    <div class="container">
        <div id="arrow_wrapper" class="clear_fix">
            <a href="/" class="home"> </a>
            <a href="javascript:;" class="btn_m_close" id="btn_m_close"> </a>
            {{--                    <a href="" class="logout_link"> <span class="logout"></span> <span>로그아웃</span> </a>--}}
            <a href="" class="message_link">
                        <span class="my_message">
                            <span class="my_message_new active" >95</span>
                        </span>
            </a>
        </div>
        <div id="myinfo_wrapper">
            <span id="c_credit" class="credit_mark vip"></span>
            <div id="myinfo">
                @if (Auth::check())
                    <p> <em class="username">{{$user['name']}}({{$user['nickname']}})</em> </p>
                    <p> 내 마일리지 <span><a href="/myroom/mileage/my_mileage/"><em class="usr_mile ft_bu" id="h_mileage">{{number_format($user['mileage'])}}</em></a>원</span> </p>
                @endif
            </div>
            {{--                    <a href="">--}}
            {{--                        <span id="my_message">--}}
            {{--                            <span id="my_message_new" class="active">95</span>--}}
            {{--                        </span>--}}
            {{--                    </a>--}}
        </div>
        <div id="menu_list_wrapper" class="clear_fix">
            <ul id="menu_list">
                <li><a href="/#searchSell"><span class="menu_icon searchSell"></span><span class="menu_title">물품검색</span></a></li>
                <li><a href="/myroom/sell/sell_ing.html?strRelationType=ing"><span class="menu_icon selling"><span class="badge g_hidden" id="sell_badge">0</span></span><span class="menu_title">판매중</span></a></li>
                <li><a href="/myroom/buy/buy_ing.html?strRelationType=ing"><span class="menu_icon buying"><span class="badge g_hidden" id="buy_badge">0</span></span><span class="menu_title">구매중</span></a></li>
                <li><a href="/myroom/"><span class="menu_icon myroom"></span><span class="menu_title">마이룸</span></a></li>
                <li><a href="/#regSell"><span class="menu_icon regSell"></span><span class="menu_title">판매등록</span></a></li>
                <li><a href="/#regBuy"><span class="menu_icon regBuy"></span><span class="menu_title">구매등록</span></a></li>
                <li><a href="/myroom/mileage/charge/"><span class="menu_icon charge"></span><span class="menu_title">충전</span></a></li>
                <li><a href="/myroom/mileage/payment/"><span class="menu_icon payment"></span><span class="menu_title">출금</span></a></li>
                <li><a href="/event/"><span class="menu_icon eventMenu"></span><span class="menu_title">이벤트</span></a></li>
                <li><a href="/portal/giftcard/"><span class="menu_icon giftmall"></span><span class="menu_title">상품권사기</span></a></li>
                <li><a href="/charge/free/index.html?type=3"><span class="menu_icon freeCharge"></span><span class="menu_title">무료충전소</span></a></li>
                <li><a href="/game_info/money/"><span class="menu_icon moneyInfo"></span><span class="menu_title">시세정보</span></a></li>
                <li><a href="/myroom/myinfo/myinfo_login_record_view.html"><span class="menu_icon loginLog"></span><span class="menu_title">로그인기록</span></a></li>
                <li><a href="/guide/charge/mileage.html"><span class="menu_icon guide"></span><span class="menu_title">이용안내</span></a></li>
                <li><a href="/customer/"><span class="menu_icon customer"></span><span class="menu_title">고객센터</span></a></li>
            </ul>
        </div>
    </div>
</div>
