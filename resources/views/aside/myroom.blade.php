<div class="aside">
    <div class="nav_subject">
        <a href="/myroom/">
            마이룸<br>
            <img src="/mania/img/myroom/myroom.png" >
        </a>
    </div>
    <div class="nav">
        <div class="nav_title @if($group == 'message') on_active @endif"><a href="/myroom/message/">메세지함</a></div>
        <div class="nav_title @if($group == 'sell') on_active @endif"><a href="/myroom/sell/sell_regist">판매관련</a></div>
        <div class="nav_title @if($group == 'buy') on_active @endif"><a href="/myroom/buy/buy_regist">구매관련</a></div>
{{--        <div class="nav_title @if($group == 'alert') on_active @endif"><a href="/myroom/goods_alarm/alarm_sell_list">물품등록 알리미<span class="new">N</span></a></div>--}}
        <div class="nav_title @if($group == 'end') on_active @endif"><a href="/myroom/complete/sell">종료내역</a></div>
        <div class="nav_title @if($group == 'cancel') on_active @endif"><a href="/myroom/complete/cancel_sell">취소내역</a></div>
        <div class="nav_title {{$group == 'mileage' ? 'on_active' : ''}}"><a href="{{route('my_mileage_index_c')}}">마일리지</a></div>
        <div class="nav_title @if($group == 'person') on_active @endif"><a href="/myroom/myinfo/myinfo_check">개인정보</a></div>
        <div class="nav_title @if($group == 'money') on_active @endif"><a href="/myroom/cash_receipt/cash_receipt_list">현금영수증</a></div>
{{--        <div class="nav_title @if($group == 'using') on_active @endif"><a href="/myroom/coupon/free">이용권현황</a></div>--}}
{{--        <div class="nav_title @if($group == 'security') on_active @endif"><a href="/myroom/myinfo/myinfo_safe_settlement">보안센터</a></div>--}}
        <div class="nav_title @if($group == 'settings') on_active @endif"><a href="/myroom/customer/">환경설정</a></div>
        <div class="nav_title @if($group == 'exit') on_active @endif"><a href="/myroom/user_leave/user_leave_form">회원탈퇴</a></div>
    </div>
</div>
