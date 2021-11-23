@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/customer/css/customer_common.css" />
    <link type="text/css" rel="stylesheet" href="/mania/_css/_table.css?190219" />
    <link type="text/css" rel="stylesheet" href="/mania/customer/css/report.css?210503" />
    <link type="text/css" rel="stylesheet" href="/mania/customer/css/_report_top.css?210503" />
    <link type="text/css" rel="stylesheet" href="/mania/customer/report/css/index.css?210503" />
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/customer/report/js/index.js?210503"></script>
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
        @include('mania.customer.aside', ['group'=>'report', 'part'=>'guide'])
        <div class="g_content">
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue no-border">1:1 상담하기</div>
            <!-- ▲ 타이틀 //-->
            <div class="g_finish"></div>
            <!-- ▼ 상담분류선택 //-->
            <div class="s_subtitle">상담 분류 선택</div>
            <table class="g_sky_table category_tb" id="category_tb">
                <colgroup>
                    <col width="130">
                    <col width="630">
                </colgroup>
                <tr>
                    <th>문의 유형</th>
                    <td>
                        <ul class="g_sideway category_etc">
                            <li>
                                <input type="radio" name="b_code" value="01" class="g_radio" id="a50100" data-acode="A5" {{$faqType == 'login' ? 'checked' : ''}} data-type="login">
                                <label for="a50100">로그인문의</label>
                            </li>
                            <li>
                                <input type="radio" name="b_code" value="01" class="g_radio" id="a00100" data-acode="A0" {{$faqType == 'charge' ? 'checked' : ''}} data-type="charge">
                                <label for="a00100">충전/입금문의</label>
                            </li>
                            <li>
                                <input type="radio" name="b_code" value="02" class="g_radio" id="a00200" data-acode="A0" {{$faqType == 'exchange' ? 'checked' : ''}} data-type="exchange">
                                <label for="a00200">출금문의</label>
                            </li>
                            <li>
                                <input type="radio" name="b_code" value="04" class="g_radio" id="a50400" data-acode="A5" {{$faqType == 'other' ? 'checked' : ''}} data-type="other">
                                <label for="a50400">기타문의</label>
                            </li>
                            <li>
                                <input type="radio" name="b_code" value="03" class="g_radio" id="faulty" {{$faqType == 'faulty' ? 'checked' : ''}} data-type="faulty">
                                <label for="faulty">비거래 물품 신고</label>
                            </li>
                        </ul>
                    </td>
                </tr>
            </table>
            <!-- ▲ 상담분류선택 //-->
            <div class="g_finish"></div>
            <div class="s_subtitle">자주하는 질문 TOP</div>
            <div class="list_wrap" id="top_faq">
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
            @if ($faqType != 'normal')
                @if ($faqType != 'faulty')
                    <div class="s_subtitle">상담서작성하기</div>
                    <form id="customer_report" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="a_code" value="A5">
                        <input type="hidden" name="b_code" value="01">
                        <input type="hidden" name="trade_num" value="">
                        <input type="hidden" name="type_ask" value="" id="type_ask">
                        <table class="g_gray_tb g_sky_table" id="report_tb" style="">
                            <colgroup>
                                <col width="130">
                                <col width="630">
                            </colgroup>
                            <tbody>
                            <tr class="report_tr">
                                <th>제목</th>
                                <td>
                                    <input type="text" name="subject" value="" id="title" maxlength="40" class="g_text" placeholder="※ 제목을 입력해 주세요." required>
                                </td>
                            </tr>
                            <tr class="report_tr">
                                <th>상담내용</th>
                                <td class="h_auto">
                                    <textarea name="ask_content" id="content" placeholder="※ 상담내용을 입력해 주세요." required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>첨부파일</th>
                                <td>
                                    <div class="screenshot_wrap">
                                        <div class="screen_guide"> 용량 300KB이하 jpg만 가능(최대 3개) </div>
                                        <div class="g_screenshot">
                                            <input type="text" class="g_text" readonly="">
                                            <div class="tmp_file"><span class="tmp_btn">찾아보기</span>
                                                <input type="file" name="user_screen[]">
                                            </div>
                                            <div class="ad_btn">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="g_finish"></div>
                                    <div class="screenshot_sub">* 첨부파일 용량이 초과될 경우 itemmania@itemmania.com로 이메일 발송 후 고객감동센터(1544-8278)로 문의바랍니다.</div>
                                </td>
                            </tr>
                            <tr>
                                <th>통화가능한 번호</th>
                                <td>
                                    <input type="text" placeholder="000" name="user_phone1" id="user_phone1" value="" class="g_text" maxlength="3" required> -
                                    <input type="text" placeholder="0000" name="user_phone2" id="user_phone2" value="" class="g_text" maxlength="4" required> -
                                    <input type="text" placeholder="0000" name="user_phone3" id="user_phone3" value="" class="g_text" maxlength="4" required>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="g_btn">
                            <button class="btn-color-img btn-blue-img" type="submit">확인</button>
                            <button class="btn-color-img btn-gray-img" type="reset">취소</button>
                        </div>
                    </form>
                @else
                    <form id="customer_report" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="a_code" value="B1">
                        <input type="hidden" name="b_code" value="01">
                        <input type="hidden" id="strType" value="faulty">
                        <input type="hidden" name="subject" value="비거래물품">
                        <input type="hidden" name="content" id="content" value="">
                        <input type="hidden" name="type_ask" value="" id="type_ask">
                        <table class="g_gray_tb g_sky_table">
                            <colgroup>
                                <col width="130">
                                <col width="630">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th>접수분야</th>
                                <td>비거래 물품 신고</td>
                            </tr>
                            <tr>
                                <th>이름</th>
                                <td>{{$user['name']}}</td>
                            </tr>
                            <tr>
                                <th>거래번호</th>
                                <td>#
                                    <input type="text" id="trade_num" name="trade_num" class="g_text trade_num" value="" required>
                                </td>
                            </tr>
                            <tr>
                                <th>신고사유</th>
                                <td>
                                    <ul>
                                        <li>
                                            <input type="radio" id="content_type" name="ask_content" value="직거래유도 (연락처 기재, 각종 게임 아이디, 메신저 아이디, 캐릭명 등)"> 직거래유도 (연락처 기재, 각종 게임 아이디, 메신저 아이디, 캐릭명 등)
                                        </li>
                                        <li><input type="radio" id="content_type" name="ask_content" value="불법프로그램 "> 불법프로그램</li>
                                        <li><input type="radio" id="content_type" name="ask_content" value="카테고리 위반 "> 카테고리 위반</li>
                                        <li><input type="radio" id="content_type" name="ask_content" value="거래와 관련 없는 글(욕설, 대화성글 등) "> 거래와 관련 없는 글(욕설, 대화성글 등)</li>
                                        <li><input type="radio" id="content_type" name="ask_content" value="그 외 비거래 물품 "> 그 외 비거래 물품</li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="g_btn ">
                            <button class="btn-color-img btn-blue-img " type="submit ">확인</button>
                            <button class="btn-color-img btn-gray-img " type="reset">취소</button>
                        </div>
                    </form>
                @endif
            @endif
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
