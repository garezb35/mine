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
        </style>
        @include('mania.customer.aside', ['group'=>'', 'part'=>''])
        <div class="g_content">
            <p class="f-16 c-blue-title f-bold">고객센터</p>
            <table class="customer_button_table no-border">
                <tbody>
                <tr>
                    <td>
                        <a href=""><img src="/assets/img/button/btn_using_inquery.png" /></a>
                    </td>
                    <td>
                        <a href=""><img src="/assets/img/button/btn_market_guide.png" /></a>
                    </td>
                    <td>
                        <a href=""><img src="/assets/img/button/btn_secure_service.png" /></a>
                    </td>
                    <td>
                        <a href=""><img src="/assets/img/button/btn_24_time.png" /></a>
                    </td>
                </tr>
                </tbody>
            </table>
            <form name="searchForm" id="searchForm" method="post" action="/customer/faq/index.html">
                <input type="hidden" name="second_code">
                <div class="search">
                    <div class="search_bar_wrap">
                        <input type="image" class="g_image g_right" src="http://img2.itemmania.com/new_images/portal/center/btn_search_black.png" width="24" height="24" alt="검색">
                        <div class="search_bar d-flex">
                            <div class="search_img_wrap"> 이용안내에서 궁금한 점을 빠르게 <br>찾아보세요 </div>
                            <div class="search_input_wrap">
                                <input type="text" class="s_text" name="searchWord" placeholder="검색어를 입력해 주세요." value="">
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
                <div class="sub_title"> <span class="subject"><img class="g_left" src="http://img2.itemmania.com/new_images/customer/ico_q.png" width="14" height="21" alt="">[입금]</span> <span>[내전용계좌]로 입금을 했으나 마일리지 적립이 안 되어 있습니다. 왜 그런가요?</span> </div>
                <div class="gray_box"> <img class="g_left" src="http://img3.itemmania.com/new_images/customer/ico_a.png" width="16" height="19" alt="">
                    <div class="g_left">[내전용계좌]로 입금하면 고객님의&nbsp;아이디에 마일리지는 자동 적립됩니다.
                        <br />
                        <br /> 만약 [내 전용계좌]로 입금 후&nbsp; 5~6분 이상 경과되어도 마일리지가 충전되지 않았다면 아래 내용을 정확히 기재해 [고객감동센터] &gt; [1:1상담하기]&gt;[충전/입금문의]를 통해 접수해 주시면 확인 후 처리해 드리겠습니다.
                        <br />
                        <br /> 1. 입금은행 :
                        <br /> 2. 입금한 계좌번호 :
                        <br /> 3. 입금자명 :
                        <br /> 4. 입금금액 :
                        <br /> 5. 입금시간(날짜,시간) :</div>
                </div>
                <div class="g_finish"></div>
                <div class="sub_title"> <span class="subject"><img class="g_left" src="http://img2.itemmania.com/new_images/customer/ico_q.png" width="14" height="21" alt="">[구매문제발생]</span> <span>판매자가 해킹머니(아이템)을 판매했어요. 어떻게 해야 하나요?</span> </div>
                <div class="gray_box"> <img class="g_left" src="http://img3.itemmania.com/new_images/customer/ico_a.png" width="16" height="19" alt="">
                    <div class="g_left">먼저, 고객님의 소중한 계정에 문제가 발생된 점 대단히 죄송합니다.
                        <br />
                        <br /> 해킹머니나 아이템의 경우 게임사측 정지사유 확인 후 처리가 가능합니다.
                        <br />
                        <br /> 번거로우시겠지만, 아래 세 가지가 확인되는 게임사측 답변을 캡쳐하여 [고객감동센터] &gt; [1:1 상담하기] &gt; [거래사고신고]를 통해 파일 첨부 부탁드립니다.
                        <br />
                        <br /> ▶<font color="#3366ff"> 게임사 계정정지사유 (예:해킹머니, 도용머니) <br />
                        </font>▶ <font color="#3366ff">사고 물품이 이동된 날짜, 시간 <br />
                        </font>▶ <font color="#3366ff">문제 된 게임머니 수량<br />
                        </font>
                        <br /> 판매자는 당사 이용약관에 따라 판매한 물품으로 인해 구매자에게 피해가 발생하였을 경우 민, 형사상의 모든 책임을 진다는 부분에 동의하였으므로, 피해 부분에 대해서는 판매자에게 보상을 요청할 수 있습니다.
                        <br />
                        <br /> 또한, 해킹물품 구매로 인한 피해에 대해 보상을 받으실 수 있도록 담당자가 도움을 드리고 있으니, 문제 발생 시 [고객감동센터] &gt; [1:1 상담하기] &gt; [거래사고신고]로 사고 접수 해주시기 바랍니다.</div>
                </div>
                <div class="g_finish"></div>
                <div class="sub_title"> <span class="subject"><img class="g_left" src="http://img2.itemmania.com/new_images/customer/ico_q.png" width="14" height="21" alt="">[출금]</span> <span>타인 명의로 출금을 하려 합니다. 어떻게 해야 하나요? </span> </div>
                <div class="gray_box"> <img class="g_left" src="http://img3.itemmania.com/new_images/customer/ico_a.png" width="16" height="19" alt="">
                    <div class="g_left">아이템매니아 가입자와 출금 계좌 예금주가 다르면 출금 신청이 되지 않습니다.
                        <br />
                        <br /> 부득이한 경우 <font color="#3366ff">가족 명의의 계좌로만 출금 가능하며, 이 때에는 가입자와 예금주가 직계 가족임을 확인할 수 있는 서류를 당사로 보내 주셔야 합니다</font>. (서류상에 반드시 가입자와 예금주가 동시에 나와 있어야 합니다)
                        <br />
                        <br /> 서류 접수 시에는 불편하시더라도 아래 4가지 사항을 확인해 주시기 바랍니다.
                        <br />
                        <br /> ① 서류는 가족관계증명서, 의료보험증 사본 또는 등본만 접수 가능합니다.
                        <br /> &nbsp;(신분증, 운전면허증, 학생증은 서류로서 인정되지 않습니다.)
                        <br /> ② 서류 신청인이 등본상 가족이 아닐 경우 서류상 효력이 없습니다.
                        <br /> &nbsp;(신청인이란 동사무소나 관할 기관 등에서 등본을 발급받은 사람을 뜻합니다.)
                        <br /> ③ 등본 및 가족관계증명서는 발급일로부터 3개월이 지나지 않았을 경우에만 처리가 가능합니다.
                        <br /> ④ 모든 서류는 주민등록번호가 보이지 않도록 발급 후 발송해 주시면 됩니다.
                        <br />
                        <br /> <font color="#ff0000">【 팩스로 서류 접수방법 】</font>
                        <br /> 팩스번호 : 0505-247-8278
                        <br /> 여백에 사용하시는 아이디를 기재하여 접수해 주시면 빠른 처리가 가능합니다.
                        <br />
                        <br /> <font color="#ff0000">【 파일을 첨부하는 방법 】</font>
                        <br /> 선명한 이미지 파일만 처리 가능하며 부분 촬영한 서류는 처리 불가능 합니다.
                        <br /> 촬영한 서류를 이미지 파일로 저장(확장자를 jpg 또는 gif 파일로 저장)한 후 홈페이지 [고객감동센터] &gt; [1:1상담하기] &gt; [마일리지/Point] &gt; [출금문의]를 통해 파일 첨부 후 접수 바랍니다.</div>
                </div>
                <div class="g_finish"></div>
                <div class="sub_title"> <span class="subject"><img class="g_left" src="http://img2.itemmania.com/new_images/customer/ico_q.png" width="14" height="21" alt="">[내마일리지]</span> <span>휴대폰 ARS 충전한 마일리지 출금하고 싶어요. </span> </div>
                <div class="gray_box"> <img class="g_left" src="http://img3.itemmania.com/new_images/customer/ico_a.png" width="16" height="19" alt="">
                    <div class="g_left">휴대폰 ARS 충전을 통해 적립된 마일리지는 <font color="#0000ff"><font color="#3366ff">물품 구매 및 상품권몰 이용만 가능하며 출금은 불가</font></font>합니다.
                        <br />
                        <br /> 충전한 금액을 사용하지 않았다면 당월 결제건에 한해 충전 취소가 가능하오니 취소를 원할 경우 [고객감동센터] &gt; [1:1 상담하기] &gt; [이용관련] &gt; [충전/입금문의]로 접수 바랍니다.</div>
                </div>
                <div class="g_finish"></div>
                <div class="sub_title"> <span class="subject"><img class="g_left" src="http://img2.itemmania.com/new_images/customer/ico_q.png" width="14" height="21" alt="">[입금]</span> <span>해외에서 입금 하는 방법을 알려주세요.</span> </div>
                <div class="gray_box"> <img class="g_left" src="http://img3.itemmania.com/new_images/customer/ico_a.png" width="16" height="19" alt="">
                    <div class="g_left">해외에서는 아래 계좌로 <font color="#3366ff">현금 입금만 가능</font>합니다.
                        <br />
                        <br /> <font color="#3366ff"><strong>[하나은행: 702-910022-37904, 예금주: 주)아이템매니아]</strong></font>
                        <br />
                        <br /> 입금 후 <font color="#3366ff"><u>3~7일</u></font>이 경과 되어야 당사에서 입금내역 확인이 가능하며 환율과 송금 수수료, 환전 수수료에 의해 고객님이 입금하신 금액보다 적은 금액이 마일리지로 적립 됩니다.
                        <br />
                        <br /> 입금 후 입금 내역서는 꼭 보관해 주시기 바라며, 3~7일 경과 후 [고객감동센터] &gt; [1:1 상담하기] &gt; [이용관련] &gt; [충전/입금 문의]를 통해 아래 내용을 기재하여 접수 바랍니다.
                        <br />
                        <br /> 1. 입금 계좌번호:
                        <br /> 2. 입금날짜:
                        <br /> 3. 금액: $
                        <br /> 4. 입금자 이름:
                        <br />
                        <br /> 입금 내역서를 스캔하여 당사 이메일(<a href="mailto:itemmania@itemmania.com"><font color="#0000ff">itemmania@itemmania.com</font></a>) 로 보내 주시면 빠른 처리가 가능합니다.
                        <br />
                    </div>
                </div>
                <div class="g_finish"></div>
            </div>
            <div class="g_finish"></div>
        </div>
        <!-- ▲ 컨텐츠 영역 //-->
    </div>
@endsection
