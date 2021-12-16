@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/customer/css/report_complete.css" />
@endsection

@section('foot_attach')

@endsection

@section('content')
    <div class="container_fulids" id="module-teaser-fullscreen">
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
        @include('angel.customer.aside', ['group'=>'report', 'part'=>''])
        <div class="pagecontainer">
            <div class="empty-high"></div>
            <div id="report_complete">
                <ul id="complete_info">
                    <li class="blue_text">고객님의 상담이 정상적으로 접수되었습니다.</li>
                    <li>상담 답변은 <span class="text-rock">[나의 질문과 답변]</span>에서 확인 하실 수 있습니다.</li>
                </ul>
                <ul class="g_list g_black3_11">
                    <li>접수된 문의는 등록된 순서대로 처리되며, 문의량이 많을 경우 처리가 지연될 수 있음을 미리 양해 부탁드립니다.</li>
                    <li class="list_non">앞으로 더 나은 서비스를 제공하도록 최선을 다하겠습니다.</li>
                    <li>다른 문의사항이 있으시면 [1:1 상담하기]를 이용해 주시기 바랍니다.</li>
                </ul>
                <div class="btn-groups_angel">
                    <a href="{{route('main_customer')}}" class="button_ok">고객센터 메인으로</a>
                    <a href="{{route('index')}}" class="button_cancel"> 메인으로</a>
                </div>
            </div>
        </div>
        <div class="empty-high"></div>
    </div>
@endsection
