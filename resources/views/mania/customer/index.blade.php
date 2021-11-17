@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/customer/css/index.css?210503" />
    <link type="text/css" rel="stylesheet" href="/mania/customer/faq/css/faq_category.css?201112" />
    <link type="text/css" rel="stylesheet" href="/mania/customer/faq/css/search.css?210524" />

    {{--    <script type="text/javascript" src="/advertise/advertise_code_head.js?v=200727"></script>--}}
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/customer/js/index.js?201112"></script>
    <script type="text/javascript" src="/mania/customer/faq/js/search.js?190220"></script>
    <script type='text/javascript'>
        var gsVersion = '2110141801';
        var _LOGINCHECK = '1';
    </script>
@endsection

@section('content')
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        <style>
            .aside .notice {
                height: 24px;
                margin-top: 20px;
                font-weight: bold;
                border-bottom: 1px solid #E1E1E1
            }

            .aside .notice img {
                margin: 5px 3px 0 0
            }

            .aside .notice_list {
                margin: 0 0 30px;
                padding-top: 10px;
                background: none;
                border: 0
            }

            .aside .notice_list li {
                margin-left: 10px;
                margin-bottom: 3px;
                color: #767676;
                font-size: 12px
            }

            .aside .img_wrap {
                box-sizing: border-box;
                width: 214px;
                margin-bottom: 10px;
                padding: 10px 0;
                text-align: center;
                border: 1px solid #E1E1E1
            }
            .customer_button_table {
                margin-top: 30px;
                margin-bottom: 22px;
            }
            .customer_button_table tr td {
                padding: 0;
                border: solid 1px #5b96c7;
            }
            .search {
                background: #67A3DA;
                padding: 26px 0;
            }
            .search .search_bar {
                height: initial;
                margin: 0;
                padding: 0;
                background-color: initial;
                width: initial;
            }
            .search .search_img_wrap {
                font-size: 18px;
                width: 300px;
                height: initial;
                margin-top: initial;
            }
            .search_input_wrap {
                width: calc(100% - 300px);
                margin-right: 20px;
            }
            .s_text {
                width: calc(100% - 20px);
                padding: 14px 10px;
                font-size: 14px;
            }
            .search_bar_wrap .g_image {
                position: absolute;
                right: 10px;

            }
            .search_list {
                padding: 18px 0;
                font-size: 14px;
                color: #67a3da;
            }
            .search_list li {
                word-spacing: 28px;
            }
            .cus_content {
                border: solid 1px #67a3da;
                margin-bottom: 200px;
            }
            .cus_content .gray_box {
                border-bottom: solid 1px #67a3da;
            }
            .customer_button_table a {
                display: block;
                height: 153px;
            }
        </style>
        @include('mania.customer.aside', ['group'=>'faq', 'part'=>''])
        <div class="g_content">
            <p class="f-16 c-blue-title f-bold">고객센터</p>
            <table class="customer_button_table no-border">
                <tbody>
                <tr>
                    <td>
                        <a href="{{route('customer_report')}}"><img src="/assets/img/button/btn_using_inquery.png" /></a>
                    </td>
                    <td>
                        <a href="{{route('myqna_list')}}"><img src="/assets/img/button/btn_market_guide.png" /></a>
                    </td>
                    <td>
                        <a href="{{route('customer_safety')}}"><img src="/assets/img/button/btn_secure_service.png" /></a>
                    </td>
                    <td>
                        <a href=""><img src="/assets/img/button/btn_24_time.png" /></a>
                    </td>
                </tr>
                </tbody>
            </table>
            <form name="searchForm" id="searchForm" method="post" action="">
                @csrf
                <input type="hidden" name="second_code">
                <div class="search">
                    <div class="search_bar_wrap">
                        <input type="image" class="g_image g_right" src="http://img2.itemmania.com/new_images/portal/center/btn_search_black.png" width="24" height="24" alt="검색">
                        <div class="search_bar d-flex">
                            <div class="search_img_wrap"> 이용안내에서 궁금한 점을 빠르게 <br>찾아보세요 </div>
                            <div class="search_input_wrap">
                                <input type="text" class="s_text" name="searchWord" placeholder="검색어를 입력해 주세요." value="{{$searchWord}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <ul class="search_list">
                        <li>추천검색어 | </li>
                        <li><a href="#" onclick="$(this).fnSearch();">안전거래</a> </li>
                        <li><a href="#" onclick="$(this).fnSearch();">거래취소</a> </li>
                        <li class="no"><a href="#" onclick="$(this).fnSearch();">충전</a> </li>
                        <li><a href="#" onclick="$(this).fnSearch();">출금</a> </li>
                        <li><a href="#" onclick="$(this).fnSearch();">정지</a> </li>
                        <li><a href="#" onclick="$(this).fnSearch();">수수료</a> </li>
                        <li><a href="#" onclick="$(this).fnSearch();">결제</a> </li>
                        <li><a href="#" onclick="$(this).fnSearch();">신용등급</a> </li>
                        <li><a href="#" onclick="$(this).fnSearch();">거래방법</a> </li>
                    </ul>
                </div>
            </form>
            <!-- ▼ best5 //-->
            <div class="cus_content">
                @foreach ($faqRecord as $rec)
                    <div class="sub_title">
                        <span class="subject">
                            <img class="g_left" src="/mania/img/icons/ico_q.png" width="14" height="21" alt="">[{{$rec['type']}}]
                        </span>
                        <span>{{$rec['title']}}</span>
                    </div>
                    <div class="gray_box">
                        <img class="g_left" src="/mania/img/icons/ico_a.png" width="16" height="19" alt="">
                        <div class="g_left">
                            {!! $rec['content'] !!}
                        </div>
                    </div>
                    <div class="g_finish"></div>
                @endforeach
            </div>
            <div class="g_finish"></div>
        </div>
        <!-- ▲ 컨텐츠 영역 //-->
    </div>
@endsection
