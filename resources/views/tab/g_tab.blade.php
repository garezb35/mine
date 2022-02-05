@if(empty($category))
    <div class="react_nav_tab navs__pops">
        <div @if($group == 'sell_regist') class='selected' @endif><a href="{{route('sell_regist')}}?strRelationType=regist">판매등록물품</a></div>
        <div @if($group == 'sell_pay_wait') class='selected' @endif><a href="/myroom/sell/sell_pay_wait?strRelationType=pay" >입금 대기 물품</a></div>
        <div @if($group == 'sell_ing') class='selected' @endif><a href="{{route('sell_ing')}}?strRelationType=ing" >판매중인 물품</a></div>
    </div>
@else
    @if($category == 'buy')
        <div class="react_nav_tab navs__pops">
            <div @if($group == 'buy_regist') class='selected' @endif><a href="/myroom/buy/buy_regist?strRelationType=regist">구매등록물품</a></div>
            <div @if($group == 'buy_pay_wait') class='selected' @endif><a href="/myroom/buy/buy_pay_wait?strRelationType=pay">입금해야할 물품</a></div>
            <div @if($group == 'buy_ing') class='selected' @endif><a href="/myroom/buy/buy_ing?strRelationType=ing">구매중인 물품</a></div>
        </div>
    @endif
@endif

