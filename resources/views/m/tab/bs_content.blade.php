@if($group == 'sell')
    <div class="body_rt34DF sell__f34fFC">
        <div class="icon_wrap"> <span class="has-sprite sell_icon">판매</span> </div>
        <div class="regist_product">
            <div class="regist_title">판매등록</div>
            <a href="/myroom/sell/sell_regist?strRelationType=regist" class="regist_result">{{$selling_register}}</a>
        </div>
        <div class="bargain_request_product">
            <div class="bargain_request_title">흥정신청</div>
            <a href="/myroom/sell/sell_check?strRelationType=check" class="bargain_request_result">{{$bargain_request}}</a>
        </div>
        <div class="box_line"></div>
        <div class="step_title deposit_product_title">
            <br/>입금 대기 물품
        </div>
        <a href="/myroom/sell/sell_pay_wait?strRelationType=pay" class="deposit_product">{{$pay_pending}}<span> </span></a> <span class="has-sprite arr_icon arr1"></span>
        <div class="step_title product_title">
            <br/>판매중인 물품
        </div>
        <a href="/myroom/sell/sell_ing?strRelationType=ing" class="sell_product">{{$selling_count}}<span> </span></a> <span class="has-sprite arr_icon arr2"></span>
        <div class="step_title complete_title">
            <br/>판매종료
        </div>
        <a href="/myroom/complete/sell" class="detail_btn">자세히보기<span class="has-sprite arr_right"></span></a>
    </div>
@else
<div class="body_rt34DF buy__h34Efd">
    <div class="icon_wrap"> <span class="has-sprite buy_icon">구매</span> </div>
    <div class="regist_product">
        <div class="regist_title">구매등록</div>
        <a href="/myroom/buy/buy_regist?strRelationType=regist" class="regist_result">{{$buying_register}}</a>
    </div>
    <div class="bargain_request_product">
        <div class="bargain_request_title">흥정신청</div>
        <a href="/myroom/buy/buy_check?strRelationType=check" class="bargain_request_result">{{$bargain_request}}</a>
    </div>
    <div class="box_line"></div>
    <div class="step_title deposit_product_title">
        <br/>입금해야 할 물품
    </div>
    <a href="/myroom/buy/buy_pay_wait?strRelationType=pay" class="deposit_product">{{$pay_pending}}<span></span></a> <span class="has-sprite arr_icon arr1"></span>
    <div class="step_title product_title">
        <br/>구매중인 물품
    </div>
    <a href="/myroom/buy/buy_ing?strRelationType=ing" class="sell_product">{{$buying_count}}<span></span></a> <span class="has-sprite arr_icon arr2"></span>
    <div class="step_title complete_title">
        <br/>구매완료
    </div>
    <a href="/myroom/complete/buy" class="detail_btn">자세히보기<span class="has-sprite arr_right"></span></a>
</div>
@endif
