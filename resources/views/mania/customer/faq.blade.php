@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/customer/faq/css/faq_category.css?201112" />
    <link type="text/css" rel="stylesheet" href="/mania/customer/faq/css/search.css?210524" />
    <link type="text/css" rel="stylesheet" href="/mania/customer/faq/css/index.css?210524" />
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/customer/faq/js/search.js?190220"></script>
    <script type="text/javascript" src="/mania/customer/faq/js/index.js?210503"></script>
    <script type="text/javascript">
        function __init() {

        }
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
        @include('mania.customer.aside', ['group'=>'', 'part'=>''])
        <div class="g_content">
            <div class="g_title_blue">FAQ
                <ul class="g_path">
                    <li>홈</li>
                    <li>고객센터</li>
                    <li class="select">FAQ</li>
                </ul>
            </div>
            <div class="g_finish"></div>
            <form name="searchForm" id="searchForm" method="post" action="/customer/faq/index>
                <input type="hidden" name="second_code">
                <div class="search">
                    <div class="search_img_wrap"> 아이템매니아 고객센터. 무엇이든 물어보세요!! </div>
                    <div class="search_bar_wrap">
                        <input type="image" class="g_image g_right" src="http://img2.itemmania.com/new_images/portal/center/btn_search_black.png" width="24" height="24" alt="검색">
                        <div class="search_bar">
                            <input type="text" class="s_text" name="searchWord" placeholder="검색어를 입력해 주세요." value=""> </div>
                        <ul class="search_list">
                            <li>추천검색어 | </li>
                            <li class="no"><a href="#" onclick="$(this).fnSearch();">충전</a> </li>
                            <li><a href="#" onclick="$(this).fnSearch();">출금</a> </li>
                            <li><a href="#" onclick="$(this).fnSearch();">전용계좌</a> </li>
                            <li><a href="#" onclick="$(this).fnSearch();">수수료</a> </li>
                            <li><a href="#" onclick="$(this).fnSearch();">신용등급</a> </li>
                            <li><a href="#" onclick="$(this).fnSearch();">거래방법</a> </li>
                        </ul>
                    </div>
                </div>
            </form>
            <div class="g_finish"></div>
            <!-- ▼ FAQ 선택 //-->
            <div class="s_subtitle">FAQ 선택</div>
            <div class="divider"></div>
            <ul class="faq_category first">
                <li class="big_category">마일리지</li>
                <li><a href="/customer/faq/index.html?code=021001000">내마일리지</a></li>
                <li><a href="/customer/faq/index.html?code=021002000">입금</a></li>
                <li><a href="/customer/faq/index.html?code=021003000">충전</a></li>
                <li><a href="/customer/faq/index.html?code=021004000">결제</a></li>
                <li><a href="/customer/faq/index.html?code=021005000">출금</a></li>
            </ul>
            <ul class="faq_category">
                <li class="big_category">거래방법</li>
                <li><a href="/customer/faq/index.html?code=022001000">일반거래</a></li>
                <li><a href="/customer/faq/index.html?code=022002000">분할거래</a></li>
                <li><a href="/customer/faq/index.html?code=022004000">흥정거래</a></li>
                <li><a href="/customer/faq/index.html?code=022003000">알아두기</a></li>
                <li><a href="/customer/faq/index.html?code=022005000">수수료</a></li>
                <li><a href="/customer/faq/index.html?code=022006000">거래취소/종료</a></li>
            </ul>
            <ul class="faq_category">
                <li class="big_category">거래문제발생</li>
                <li><a href="/customer/faq/index.html?code=023001000">판매문제발생</a></li>
                <li><a href="/customer/faq/index.html?code=023002000">구매문제발생</a></li>
                <li><a href="/customer/faq/index.html?code=023003000">안전거래</a></li>
                <li><a href="/customer/faq/index.html?code=023004000">보상제도</a></li>
            </ul>
            <ul class="faq_category">
                <li class="big_category">포탈서비스</li>
                <li><a href="/customer/faq/index.html?code=024001000">상품권몰</a></li>
                <li><a href="/customer/faq/index.html?code=024005000">게임매니아</a></li>
                <li><a href="/customer/faq/index.html?code=024015000">싸다프라이스</a></li>
            </ul>
            <ul class="faq_category">
                <li class="big_category">회원정보</li>
                <li><a href="/customer/faq/index.html?code=025001000">회원가입</a></li>
                <li><a href="/customer/faq/index.html?code=025002000">서비스이용제한</a></li>
                <li><a href="/customer/faq/index.html?code=025003000">개인정보관리</a></li>
                <li><a href="/customer/faq/index.html?code=025004000">탈퇴</a></li>
            </ul>
            <div class="divider"></div>
            <ul class="faq_category first">
                <li class="big_category">신용등급/보안</li>
                <li><a href="/customer/faq/index.html?code=026001000">신용등급/인증</a></li>
                <li><a href="/customer/faq/index.html?code=026002000">보안센터</a></li>
                <li><a href="/customer/faq/index.html?code=026003000">마일리지결제인증</a></li>
            </ul>
            <ul class="faq_category">
                <li class="big_category">기타</li>
                <li><a href="/customer/faq/index.html?code=027008000">모바일 서비스</a></li>
                <li><a href="/customer/faq/index.html?code=027001000">부가서비스/혜택</a></li>
                <li><a href="/customer/faq/index.html?code=027002000">사용자환경설정</a></li>
                <li><a href="/customer/faq/index.html?code=027003000">거래편의기능</a></li>
                <li><a href="/customer/faq/index.html?code=027004000">현금영수증</a></li>
                <li><a href="/customer/faq/index.html?code=027005000">쇼핑포인트</a></li>
            </ul>
            <div class="g_finish"></div>
            <!-- ▲ FAQ 선택 //-->
            <div class="s_subtitle">자주하는 질문 TOP</div>
            <div class="list_wrap">
                <div class="faq_list"> <span class="subject"><img class="g_left" src="http://img2.itemmania.com/new_images/customer/ico_q.png" width="14" height="21" alt="">[구매문제발생]</span> <span>판매자가 해킹머니(아이템)을 판매했어요. 어떻게 해야 하나요?</span> </div>
                <div class="gray_box"> <img class="g_left" src="http://img3.itemmania.com/new_images/customer/ico_a.png" width="16" height="19" alt="">
                    <div class="g_left">
                        <p>먼저, 물품 구매 후 고객님의 소중한 계정에 문제가 발생되어 대단히 죄송합니다.</p>
                        <p>
                            <br /> 문의하신 내용은 게임사측 정지사유 답변 확인 후 처리 가능합니다.
                            <br /> 번거로우시겠지만, 아래 세 가지가 확인되는 게임사측 답변을 캡쳐하여 [고객감동센터] &gt; [1:1 상담하기] &gt; [거래사고신고]를 통해 파일 첨부 부탁드립니다.
                            <br /> ▶ 게임사 계정정지사유 (예:해킹머니, 도용머니)
                            <br /> ▶ 사고 물품이 이동된 날짜, 시간
                            <br /> ▶ 문제 된 게임머니 수량</p>
                        <p>
                            <br /> 판매자는 당사 이용약관에 따라 구매자에게 판매 물품으로 인한 피해가 발생하였을 경우 민, 형사상의 모든 책임을 진다는 부분에 동의하였으므로 해킹물품으로 인한 피해 부분에 대해 보상을 요구할 수 있습니다.
                            <br /> 또한, 구매자는 해킹물품을 구매함으로 인한 피해에 대해 보상을 받으실 수 있도록 담당자가 도움을 드리고 있으니, 문제 발생 시 고객감동센터로 사고 접수 해주시기 바랍니다.</p>
                        <p>
                            <br /> 현금거래는 불법이라 함은 각 게임사의 이용 약관일 따름이며 법적으로 절대 문제가 없습니다.</p>
                    </div>
                </div>
                <div class="g_finish"></div>
                <div class="faq_list"> <span class="subject"><img class="g_left" src="http://img2.itemmania.com/new_images/customer/ico_q.png" width="14" height="21" alt="">[안전거래]</span> <span>여러 가지 사기 유형에 대해서 알고 싶어요. </span> </div>
                <div class="gray_box"> <img class="g_left" src="http://img3.itemmania.com/new_images/customer/ico_a.png" width="16" height="19" alt="">
                    <div class="g_left"><font color="#3366ff">[해킹 게임머니(아이템) 구매]</font>
                        <br /> 판매자가 해킹/도용 아이템 또는 게임머니를 판매하여 구매자 계정이 블록되는 경우가 발생합니다.
                        <br />
                        <br /> <font color="#3366ff">[제 3자가 물품을 가로채는 사기]</font>
                        <br /> 구매자와 판매자 사이에 제 3자가 개입하여 구매자와 판매자를 기망하고 거래물품을 가로채는 사기입니다.
                        <br /> 반드시 당사 홈페이지에서 구매자의 캐릭터명과 연락처를 확인 후 거래하시기 바랍니다.
                        <br />
                        <br /> <font color="#3366ff">[입금대기 사기]</font>
                        <br /> 물품 등록 시 연락처를 노출하거나 게임 내 또는 메신저를 통해 미리 약속을 하고 거래를 하는 경우 입금대기/거래대기 상태에서 물품을 인계하여 피해가 발생되는 사기입니다.
                        <br /> 반드시 홈페이지를 통해 거래 진행 상황을 확인 후 거래하시기 바랍니다.
                        <br />
                        <br /> <font color="#3366ff">[휴대폰을 이용한 문자사기]</font>
                        <br /> 물품 등록 시 휴대폰 번호를 노출시켜 아이템매니아에서 발송되는 문자와 유사 또는 동일하게 거래금액이 결제되었다는 내용의 허위 문자를 발송하여 물품을 받아가는 사기입니다.
                        <br /> 반드시 홈페이지를 통해 거래 진행 상황을 확인 후 거래하시기 바랍니다.
                        <br />
                        <br /> <font color="#3366ff">[유사 캐릭터를 이용한 사기]</font>
                        <br /> 구매자 또는 제 3자가 구매자 캐릭터명 또는 전화, 1:1대화함 상으로 확인 된 캐릭터명과 유사한 캐릭터명으로 판매자에게 접근하여 구매자인척 물품을 받아가는 사기입니다.
                        <br /> 반드시 당사 홈페이지에서 구매자의 캐릭터명과 연락처를 확인 후 거래하시기 바랍니다.
                        <br />
                        <br /> <font color="#3366ff">[거래 완료 후 물품을 되돌려달라고 하는 사기]</font>
                        <br /> 게임상에서 물품을 인계한 후 판매자 또는 판매자와 유사한 캐릭터명 생성하여 거래물품에 문제가 있다며 게임내 채팅상으로 대화를 한 뒤 거래물품을 다시 받아 가는 사기입니다.
                        <br /> 이미 받은 물품을 돌려달라고하는 경우 돌려주기 전에 [고객감동센터 1544-8278]로 먼저 문의해 주시기 바랍니다.
                        <br />
                        <br /> 기타 자세한 사고 유형은 <font color="#3366ff">[고객감동센터] &gt; [안전거래]&nbsp; &gt; [사기/사고유형] </font><font color="#000000">확인 부탁 드립니다.</font></div>
                </div>
                <div class="g_finish"></div>
                <div class="faq_list"> <span class="subject"><img class="g_left" src="http://img2.itemmania.com/new_images/customer/ico_q.png" width="14" height="21" alt="">[안전거래]</span> <span>사기를 당하지 않으려면 어떻게 해야 하나요? </span> </div>
                <div class="gray_box"> <img class="g_left" src="http://img3.itemmania.com/new_images/customer/ico_a.png" width="16" height="19" alt="">
                    <div class="g_left">거래 중 사기 유도가 되지 않으려면 아래 내용을 꼭 숙지해 주시기 바랍니다.
                        <br />
                        <br /> 1. <font color="#3366ff">게임내에서 먼저 약속을 하고 거래 진행하거나 메신저를 통해 대화를 나눈 뒤 거래 하지 않습니다.<br />
                        </font>
                        <br /> 2. 거래가 신청되었다는 문자 메시지가 전송 되었다면 <font color="#3366ff">[마이룸] &gt; [판매(구매)중인 물품]에서 실제로 입금 확인이 되었는지 확인</font>해야 합니다.
                        <br />
                        <br /> 3. 거래중인 물품에 기재된 판매자/구매자의 연락처로 <font color="#3366ff">통화를 하여 서로에 대한 확인</font>을 합니다. (카테고리, 판/구매자 캐릭터명 등)
                        <br />
                        <br /> 4. 게임상에서 물품을 교환 할 때 <font color="#3366ff">판매자/구매자의 캐릭터명을 다시 한번 확인</font> 후 교환신청을 합니다.
                        <br />
                        <br /> 5. 교환을 신청 후 상대편에 교환신청이 되었는지, 교환창이 띄워졌는지 거래물품을 올린 후 구매자에게 <font color="#3366ff">거래하려는 수량이나 물품이 맞는지</font> 지속적으로 확인을 해야 합니다.
                        <br />
                        <br /> 6. 만약을 대비해 교환 당시의 내용을 확인할 수 있는 <font color="#3366ff">교환 당시 거래창과 완료창을 스크린샷 촬영</font>해 두시는 게 좋습니다.
                        <br />
                        <br /> 7. 물품을 받은 후 되돌려 주지 않도록 주의해 주시기 바랍니다.
                        <br />
                        <br /> 위 내용을 지키지 못해 문제가 발생했을 경우 불이익을 당할 수 있으니 참고 바랍니다..</div>
                </div>
                <div class="g_finish"></div>
                <div class="faq_list"> <span class="subject"><img class="g_left" src="http://img2.itemmania.com/new_images/customer/ico_q.png" width="14" height="21" alt="">[안전거래]</span> <span>입금되었다는 문자를 받았는데 문자만 받고 거래해도 되나요? </span> </div>
                <div class="gray_box"> <img class="g_left" src="http://img3.itemmania.com/new_images/customer/ico_a.png" width="16" height="19" alt="">
                    <div class="g_left">최근 고객님들을 상대로 <font color="#3366ff">허위로 입금되었다고 문자를 발송하고 등록한 물품이 입금확인 된 것처럼 속인 후 거래에 해당하는 물품을 받아가는 사고</font>가 발생되고 있습니다.
                        <br />
                        <br /> <font color="#ff0000">【 사고발생 원인 】 <br />
                        </font>판매 등록 시 <font color="#3366ff">상세내용에 휴대폰 번호를 기재</font><font color="#3366ff">하여 발생</font>되며, 홈페이지 &gt; [마이룸]에서 입금확인 여부를 확인하지 않고, 입금문자만 보고 물품을 넘겨주는 사고건입니다.
                        <br />
                        <br /> <font color="#ff0000">【 사고예방 방법 】</font>
                        <br /> - 판매 등록 시에는 개인정보(휴대폰 번호, 캐릭터명, 메신저주소, 카카오톡 아이디 등)을 기재하시면 안됩니다.
                        <br /> - 구매자 입금확인은 홈페이지 [마이룸] &gt; [판매중인 물품]에서만 확인하시고 거래중 물품에 기재된 구매자 케릭터에게 물품을 넘겨 주시기 바랍니다.</div>
                </div>
                <div class="g_finish"></div>
                <div class="faq_list"> <span class="subject"><img class="g_left" src="http://img2.itemmania.com/new_images/customer/ico_q.png" width="14" height="21" alt="">[알아두기]</span> <span>물품 등록 후 일정 기간이 지나면 자동으로 삭제되나요?</span> </div>
                <div class="gray_box"> <img class="g_left" src="http://img3.itemmania.com/new_images/customer/ico_a.png" width="16" height="19" alt="">
                    <div class="g_left">보다 안전하고 신속한 거래를 위해 등록하는 모든 물품에 거래등록 유지기간이 자동으로 설정되어 있습니다.
                        <br /> 모든 물품(등록대기상태,종료된 물품)이 7일 동안 유지가 가능하며, 7일 후 물품이 자동으로 삭제됩니다.</div>
                </div>
                <div class="g_finish"></div>
                <div class="faq_list"> <span class="subject"><img class="g_left" src="http://img2.itemmania.com/new_images/customer/ico_q.png" width="14" height="21" alt="">[흥정거래]</span> <span>다시 흥정신청을 하려고 하는데 신청이 안돼요. </span> </div>
                <div class="gray_box"> <img class="g_left" src="http://img3.itemmania.com/new_images/customer/ico_a.png" width="16" height="19" alt="">
                    <div class="g_left">구매자의 무분별한 흥정 신청을 막기 위하여, <font color="#3366ff">판매자 흥정 수락된 거래에 입금 확인을 하지 않을 경우 해당 물품에 다시는 흥정신청을 할 수 없습니다.<br />
                        </font>
                        <br /> 흥정 신청 시,&nbsp; 가격을 신충하게 결정하여 신청해 주시기 바랍니다.</div>
                </div>
                <div class="g_finish"></div>
                <div class="faq_list"> <span class="subject"><img class="g_left" src="http://img2.itemmania.com/new_images/customer/ico_q.png" width="14" height="21" alt="">[입금]</span> <span>[내전용계좌]로 입금을 했으나 마일리지 적립이 안 되어 있습니다. 왜 그런가요?</span> </div>
                <div class="gray_box"> <img class="g_left" src="http://img3.itemmania.com/new_images/customer/ico_a.png" width="16" height="19" alt="">
                    <div class="g_left">[내전용계좌]로 입금을 하시면 고객님의 아이디로 마일리지가 자동 적립됩니다.
                        <br />
                        <br /> 전용계좌 중 일부 은행(우체국, 신한, 우리, 씨티)은 보이스 피싱 예방관련으로 충전 한 금액이 마일리지로 적립 되기까지 5분~10분 정도 소요되고 있습니다.
                        <br />
                        <br /> 만약 [내전용계좌]로 입금 후<u> <font color="#3366ff">5~10분</font></u> 이상 경과되어도 충전이 되지 않는다면 아래 내용을 정확히 기재하여 [고객감동센터] &gt; [1:1상담하기] &gt; [마일리지/Point] &gt; [충전/입금문의]를 통해 접수해 주시기 바랍니다.
                        <br />
                        <br /> 1.<font color="#3366ff"> 입금은행</font> :
                        <br /> 2. <font color="#3366ff">입금한 계좌번호</font> :
                        <br /> 3.<font color="#3366ff"> 입금자명</font> :
                        <br /> 4. <font color="#3366ff">입금금액</font> :
                        <br /> 5. <font color="#3366ff">입금시간(날짜, 시간)</font> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                </div>
                <div class="g_finish"></div>
            </div>
            <div class="g_finish"></div>
            <div class="gray_content">
                <div class="g_left">궁금한 항목에 대한 FAQ가 없으시다면, 1:1 상담하기를 이용해 주세요.</div>
                <div class="s_btn"><a href="/customer/report/index>1:1상담하기</a></div>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
