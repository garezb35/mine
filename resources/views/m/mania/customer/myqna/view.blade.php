@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/customer/css/customer_common.css?210901" />
    <link type="text/css" rel="stylesheet" href="/mania/customer/myqna/css/view.css?210503" />
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/customer/myqna/js/view.js?190220"></script>
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
        </style>
        @include('mania.customer.aside', ['group'=>'myqna', 'part'=>''])
        <div class="g_content">
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue no-border">1:1 상담하기</div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 나의 1:1 상담내역 //-->
            <div class="s_subtitle">나의 1:1 상담내역</div>
            <table class="g_gray_tb g_sky_table">
                <colgroup>
                    <col width="120" />
                    <col width="258" />
                    <col width="120" />
                    <col /> </colgroup>
                <tr>
                    <th>상담분류</th>
                    <td>
                        @switch ($askDetail['type'])
                            @case ('cancel')
                            취소요청
                            @break;
                            @case ('complete')
                            종료요청
                            @break;
                            @case ('login')
                            로그인문의
                            @break;
                            @case ('charge')
                            충전/입금문의
                            @break;
                            @case ('exchange')
                            출금문의
                            @break;
                            @case ('other')
                            기타문의
                            @break;
                            @case ('faulty')
                            비거래 물품 신고
                            @break;
                            @case ('newgame')
                            신규게임/서버 추가
                            @break;
                        @endswitch
                    </td>
                    <th>문의일자</th>
                    <td>{{date('Y-m-d H:i:s', strtotime($askDetail['created_at']))}}</td>
                </tr>
                <tr>
                    <th>제목</th>
                    <td colspan="3">{{$askDetail['subject']}}</td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td colspan="3">{{$askDetail['subject']}}</td>
                </tr>
            </table>
            <!-- ▲ 나의 1:1 상담내역 //-->
            <!-- ▼ 문의한 내용 답변보기 //-->
            <div class="s_subtitle">문의한 내용 답변보기</div>
            @if ($askDetail['response'] != '')
                <table class="g_gray_tb g_sky_table">
                    <colgroup>
                        <col width="120" />
                        <col width="258" />
                        <col width="120" />
                        <col width="257" /> </colgroup>
                    <tr>
                        <th>처리상태</th>
                        <td>처리완료</td>
                        <th>답변일자</th>
                        <td>{{date('Y-m-d H:i:s', strtotime($askDetail['updated_at']))}}</td>
                    </tr>
                    <tr>
                        <th>답변내용</th>
                        <td colspan="3">
                            {{$askDetail['response']}}
                        </td>
                    </tr>
                </table>
            @endif
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->

@endsection
