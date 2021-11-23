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
    .aside .nav_subject,
    .aside .nav {
        background: white !important;
        border: solid 1px #3AB7D3;
    }
    .g_list li, .g_list dd {
        padding: 0 5px;
    }
    .aside .nav > .on_active ~ .nav_sub {
        padding: 0;
        margin-top: 0px;
    }
    .aside .nav > .nav_sub {
        line-height: 30px;
        padding-left: 0px;
    }
    .aside .nav > .nav_sub .on_active {
        color: #3ab7d3;
    }
</style>

<div class="aside">
    <div class="nav_subject">
        <a href="{{route("main_customer")}}" class="">
            <p class="f-18 m-0 align-center c-black">고객센터</p>
            <div class="m-auto align-center" style="margin-top: 10px;">
                <img src="/assets/img/icons/icon_customer.png" />
            </div>
        </a>
    </div>
    <div class="nav">
        <div class="nav_title {{$group == "faq" ? "on_active" : ""}}"><a href="{{route("main_customer")}}">FAQ</a></div>
        <div class="nav_title {{$group == "report" ? "on_active" : ""}}"><a href="{{route('customer_report')}}">1:1 이용문의</a></div>
        <ul class="nav_sub g_list">
            <li class="">
                <a class="{{$part == "close" ? "on_active" : ""}}" href="{{route('customer_report')}}">거래취소 / 종료</a>
            </li>
            <li class="">
                <a class="{{$part == "guide" ? "on_active" : ""}}" href="{{route('customer_ask_guide')}}">이용관련</a>
            </li>
        </ul>
        <div class="nav_title {{$group == "myqna" ? "on_active" : ""}}"><a href="{{route('myqna_list')}}">나의 질문과 답변</a></div>
        <div class="nav_title {{$group == "newgame" ? "on_active" : ""}}"><a href="{{route('customer_newgame')}}">신규게임/서버 추가</a></div>
        <div class="nav_title {{$group == "safety" ? "on_active" : ""}}"><a href="{{route('customer_safety')}}">안전거래</a></div>
        {{--        <div class="nav_title "><a href="/customer/compensate/index>보상제도</a></div>--}}
        {{--        <div class="nav_title "><a href="/customer/compensate_buy/index>200% 구매보상</a></div>--}}
        {{--        <div class="nav_title "><a href="/customer/board/list>자료실</a></div>--}}
    </div>
</div>
