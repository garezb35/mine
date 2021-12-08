@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/customer/css/report_complete.css" />
    <!--<script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>-->
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')

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
        </style>
        @include('mania.customer.aside', ['group'=>'report', 'part'=>''])
        <div class="g_content">
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue">
                <div class="g_left"><img src="https://img3.itemmania.com/images/customer/title/title_1vs1.gif" width="109" height="19" alt="1:1 상담하기" /></div>
                <ul class="g_path">
                    <li>홈</li>
                    <li>고객센터</li>
                    <li class="select">1:1 상담하기</li>
                </ul>
            </div>
            <div class="g_gray_border"></div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 1:1 상담하기 //-->
            <div id="report_top">
                <ul class="g_left">
                    <li class="bg_icon">TAXIFY 고객센터 상담 시간은 24시간(연중무휴) 입니다.
                        <br />고객님께서 궁금하신 점이 있으시다면, 언제든지 문의 바랍니다.</li>
                </ul> <img src="https://img4.itemmania.com/images/customer/img2_1vs1.gif" width="226" height="99" alt="1:1 상담하기" class="g_right" /> </div>
            <!-- ▲ 1:1 상담하기 //-->
            <div class="g_finish"></div>
            <!-- ▼ 접수완료 //-->
            <div id="report_complete">
                <ul id="complete_info">
                    <li class="blue_text">고객님의 상담이 정상적으로 접수되었습니다.</li>
                    <li>상담 답변은 <span class="f_red1">[나의 질문과 답변]</span>에서 확인 하실 수 있습니다.</li>
                </ul>
                <ul class="g_list g_black3_11">
                    <li>접수된 문의는 등록된 순서대로 처리되며, 문의량이 많을 경우 처리가 지연될 수 있음을 미리 양해 부탁드립니다.</li>
                    <li class="list_non">앞으로 더 나은 서비스를 제공하도록 최선을 다하겠습니다.</li>
                    <li>다른 문의사항이 있으시면 [1:1 상담하기]를 이용해 주시기 바랍니다.</li>
                </ul>
                <div class="g_btn">
                    <a href="{{route('main_customer')}}" class="button_ok">고객센터 메인으로</a>
                    <a href="{{route('index')}}" class="button_cancel">TAXIFY 메인으로</a>
                </div>
            </div>
            <!-- ▲ 접수완료 //-->
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
