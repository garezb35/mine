@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/customer/css/index.css" />
    <link type="text/css" rel="stylesheet" href="/angel/customer/faq/css/faq_category.css" />
    <link type="text/css" rel="stylesheet" href="/angel/customer/faq/css/search.css" />
@endsection

@section('foot_attach')

    <script type="text/javascript" src="/angel/customer/js/index.js"></script>
    <script type="text/javascript" src="/angel/customer/faq/js/search.js?190220"></script>
    <script type='text/javascript'>
    </script>
@endsection

@section('content')
    <div class="bg-white">
        <div>
            <div></div>
            <div >
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
                        margin-bottom: 22px;
                    }
                    .customer_button_table tr td {
                        padding: 0;
                        border: solid 1px #5b96c7;
                    }
                    .search {
                        background: #3AB7D3;
                        padding: 5px 0;
                        position: relative;
                    }


                    .search_bar_wrap .v_middle_img {
                        position: absolute;
                        right: 5px;
                        top: 6px;

                    }
                    .item_filtered {
                        padding: 18px 0;
                        font-size: 14px;
                        color: #3AB7D3;
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
                    }
                    .bg-white{
                        overflow: auto;
                    }
                    .customer_button_table img{
                        width: 100%;
                    }
                </style>
                @include('angel.customer.aside', ['group'=>'faq', 'part'=>''])
                <div class="pagecontainer">
                    <table class="customer_button_table no-border">
                        <colgroup>
                            <col width="25%"/>
                            <col width="25%"/>
                            <col width="25%"/>
                            <col width="25%"/>
                        </colgroup>
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
                                <div class="search_bar">
                                    <div class="search_img_wrap"> 이용안내에서 궁금한 점을 빠르게 찾아보세요 </div>
                                    <div class="search_input_wrap">
                                        <input type="text" class="s_text" name="searchWord" placeholder="검색어를 입력해 주세요." value="{{$searchWord}}">
                                        <button style="background: none" type="submit"  class="v_middle_img"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <ul class="item_filtered">
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

                    <div class="cus_content">
                        @foreach ($faqRecord as $rec)
                            <div class="sub_title">
                            <span class="subject">
                                [{{$rec['type']}}]
                            </span>
                                <span>{{$rec['title']}}</span>
                            </div>
                            <div class="gray_box">
                                <span class="float-left" style="width: 19px;height: 19px"></span>
                                <div class="float-left">
                                    {!! $rec['content'] !!}
                                </div>
                            </div>
                            <div class="empty-high"></div>
                        @endforeach
                    </div>
                    <div class="empty-high"></div>
                </div>

            </div>
        </div>
    </div>
@endsection
