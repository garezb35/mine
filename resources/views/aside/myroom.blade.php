<div class="aside">
    <div class="nav_subject">
        <a href="http://trade.itemmania.com/myroom/">
            마이룸<br>
            <img src="/mania/img/myroom/myroom.png" >
        </a>
    </div>
    <div class="nav">
        <div class="nav_title @if($aside == 'message') on_active @endif"><a href="/myroom/message/">메세지함</a></div>
        <div class="nav_title @if($aside == 'sell') on_active @endif"><a href="/myroom/sell/sell_regist">판매관련</a></div>
        <div class="nav_title @if($aside == 'buy') on_active @endif"><a href="/myroom/buy/buy_regist">구매관련</a></div>
        <div class="nav_title @if($aside == 'alert') on_active @endif"><a href="/myroom/goods_alarm/alarm_sell_list">물품등록 알리미<span class="new">N</span></a></div>
        <div class="nav_title @if($aside == 'end') on_active @endif"><a href="/myroom/complete/sell">종료내역</a></div>
        <div class="nav_title @if($aside == 'cancel') on_active @endif"><a href="/myroom/complete/cancel_sell">취소내역</a></div>
        <div class="nav_title @if($aside == 'mileage') on_active @endif"><a href="/myroom/mileage/my_mileage/">마일리지</a></div>
        <div class="nav_title @if($aside == 'person') on_active @endif"><a href="/myroom/myinfo/myinfo_check">개인정보</a></div>
        <div class="nav_title @if($aside == 'money') on_active @endif"><a href="/myroom/cash_receipt/cash_receipt_list">현금영수증</a></div>
        <div class="nav_title @if($aside == 'using') on_active @endif"><a href="/myroom/coupon/free">이용권현황</a></div>
        <div class="nav_title @if($aside == 'security') on_active @endif"><a href="/myroom/myinfo/myinfo_safe_settlement">보안센터</a></div>
        <div class="nav_title @if($aside == 'settings') on_active @endif"><a href="/myroom/customer/">환경설정</a></div>
        <div class="nav_title @if($aside == 'exit') on_active @endif"><a href="/myroom/user_leave/user_leave_form">회원탈퇴</a></div>
    </div>
</div>
