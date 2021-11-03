<style>
    .aside .nav_subject > a {
        background: initial !important;
        text-indent: initial !important;
        display: block !important;
        margin-top: 14px
    }
    .aside .nav_subject {
        height: 115px;
    }
    .aside .nav > .nav_title {
        font-size: 16px;
        height: 50px;
        line-height: 50px;
        padding-left: 0px;
    }
    .aside .nav a {
        border-bottom: solid 1px gray;
        text-align: center;
    }
    .aside .nav_subject {
        /*background: #3AB7D3;*/
    }
</style>
<div class="aside">
    <div class="nav_subject">
        <a href="{{route("guide")}}" class="">
            <p class="f-18 m-0 c-black align-center">이용안내</p>
            <div class="m-auto align-center" style="margin-top: 10px;">
                <img src="/assets/img/icons/icon_customer.png" />
            </div>
        </a>
    </div>
    {{--    <div class="nav_subject"><a href="/guide/" class="guide">이용안내</a></div>--}}
    <div class="nav">
        <div class=" nav_title"><a href="#">이용안내</a></div>
        <div class=" nav_title"><a href="#">초보자 가이드</a></div>
        <div class=" nav_title"><a href="#">공지사항</a></div>
    </div>
    <!-- ▼ 배너 //-->
{{--    <div class="img_wrap">--}}
{{--        <p class="title">아이템매니아 고객센터</p> <span class="SpGroup img_mania_call g_left"></span>--}}
{{--        <p class="content"><span class="ft_orange">전화상담 1544-8278</span>--}}
{{--            <br/>팩스 0505-247-8278--}}
{{--            <br/>상담시간 : 24시간(연중무휴)</p>--}}
{{--    </div>--}}
{{--    <a href="javascript:_window.open('Callme','/customer/callme.html',500,420)" class="img_wrap callme"> <span class="SpGroup img_callme g_left"></span>--}}
{{--        <p class="callme_title">연락처를 남기세요.--}}
{{--            <br/><span>콜미 서비스</span><span class="go_btn">바로가기</span></p>--}}
{{--    </a>--}}
<!-- ▲ 배너 //-->
</div>
