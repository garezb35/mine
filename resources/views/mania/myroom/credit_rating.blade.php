@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/myinfo/css/credit_rating.css">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/myroom/myinfo/js/credit_rating.js"></script>
@endsection
@section('content')
    <div class="g_container" id="g_CONTENT">
        @include('aside.myroom',['group'=>''])
        <div class="g_content">
            <div class="g_title_blue noborder">
                신용등급/인증
            </div>
            <div class="credit_info">
                <span class="credit_mark _lg vip"><i></i></span>
                <div class="credit_name">
                    <div class="f_bold">이장훈님의 신용등급은
                        <span class="vip_txt">VIP</span>입니다.
                    </div>
                    전체거래점수 : <strong class="f_red1">908점</strong>
                </div>
                <div class="credit_gift">
                    <img src="http://img3.itemmania.com/new_images/myroom/icon_shopping_5p.jpg" width="111" height="53" alt="쇼핑포인트 5% 적립"><span class="plus_icon"></span><img src="http://img3.itemmania.com/new_images/myroom/icon_free_20p.jpg" width="111" height="53" alt="무료이용권 20장"><span class="plus_icon"></span><img src="http://img3.itemmania.com/new_images/myroom/icon_withdraw_12.jpg" width="111" height="53" alt="무료출금 이용권 12장">
                </div>
            </div>
            <!-- ▼ 신용등급별 혜택 //-->
            <div class="g_subtitle">신용등급별 혜택</div>
            <div class="benefit">
                <div class="my_benefit vip">
                    <ul class="benefit_cnt">
                        <li class="">
                            프리미엄 <span>5장</span><br>
                            <em>(쇼핑P 1% 적립)</em>
                            <div>5점 미만</div>
                        </li>
                        <li class="">
                            프리미엄 <span>5장</span><br>
                            물품강조 <span>5장</span><br>
                            <em>(쇼핑P 2% 적립)</em>
                            <div>5점 이상</div>
                        </li>
                        <li class="">
                            프리미엄 <span>5장</span><br>
                            물품강조 <span>5장</span><br>
                            <em>(쇼핑P 3% 적립)</em>
                            <div>51점 이상</div>
                        </li>
                        <li class="">
                            프리미엄 <span>7장</span><br>
                            물품강조 <span>7장</span><br>
                            <em>(쇼핑P 4% 적립)</em>
                            <div>101점 이상(5점이상)</div>
                        </li>
                        <li class="on">
                            무료출금 <span>12장</span><br>
                            프리미엄 <span>10장</span><br>
                            물품강조 <span>10장</span><br>
                            <em>(쇼핑P 5% 적립)</em>
                            <div>301점 이상(10점이상)</div>
                        </li>
                    </ul>
                    <div class="over"></div>
{{--                    <a href="javascript:;" onclick="Fncredit_ajax(1);" class="credit_btn">발급받기</a>--}}
                </div>

{{--                <div class="ssada_benefit">--}}
{{--                    <a href="https://ssadaprice.itemmania.com" target="_blank" class="btn_ssada"><img src="http://img4.itemmania.com/new_images/myroom/btn_ssada_go.png"></a>--}}
{{--                    <a href="https://ssadaprice.itemmania.com/event/event_ecoupon/index?event_div=credit" target="_blank" class="btn_ssada_gift"><img src="http://img4.itemmania.com/new_images/myroom/btn_ssada_gift.png"></a>--}}
{{--                    <a href="javascript:FnSsadaCouponIssue_ajax();" class="btn_ssada_down"><img src="http://img4.itemmania.com/new_images/myroom/btn_ssada_down.png"></a>--}}
{{--                    <div class="ssada_info">--}}
{{--                        <p>알아두기 <a href="javascript:;" class="btn_blue4" onmouseover="$('#ssada_infobox').show();" onmouseout="$('#ssada_infobox').hide();">자세히보기</a></p>--}}
{{--                        <div id="ssada_infobox" class="g_msgbox blue ssada_infobox">--}}
{{--                            <div class="title">E쿠폰 혜택</div>--}}
{{--                            <ul style="margin-bottom:7px;">--}}
{{--                                <li>--}}
{{--                                    ▶ 발급 방법<br>--}}
{{--                                    싸다프라이스 로그인 &gt; 혜택 받기 버튼 클릭 시 &gt; LMS로 상품 정보 전송<br>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    ▶ 알아두기<br>--}}
{{--                                    - 골드, 플래티넘, VIP 회원에 한해 지급 가능<br>--}}
{{--                                    - SMS 수신 동의한 회원에 한해 혜택 지급 가능<br>--}}
{{--                                    - 바코드 이미지 제공 불가하며, 핀번호 형식으로 전송--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <div class="title">싸다프라이스 할인쿠폰</div>--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    ▶ 쿠폰 정보<br>--}}
{{--                                    권종 : 3,000원(50,000 이상 결제 시 사용 가능)<br>--}}
{{--                                    유효기간 : 발급일로부터 30일<br>--}}
{{--                                    사용 불가 카테고리 : 게임매니아 캐시, 백화점 상품권, 이벤트 상품<br>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    ▶ 확인방법<br>--}}
{{--                                    싸다프라이스 로그인 &gt; 마이페이지 &gt; 할인쿠폰에서 발급 여부 확인 가능--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        - 이달의 선물은 매월 셋째 주 수요일에 오픈됩니다.<br>--}}
{{--                        - 이달의 선물은 월 1회 선착순 지급 가능합니다.(상품 소진 시까지)<br>--}}
{{--                        - 이달의 선물은 골드, 플래티넘, VIP 회원에 한해 지급 가능합니다.<br>--}}
{{--                        - 싸다프라이스 할인쿠폰은 월 1회 발급 가능합니다.<br>--}}
{{--                        - 싸다프라이스 할인쿠폰은 마이페이지 &gt; 할인쿠폰에서 확인 가능합니다.--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="add_info">--}}
{{--                    <ul>--}}
{{--                        <li>--}}
{{--                            <span class="SpGroup icon_member"></span>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <p>회원등급 <a href="javascript:;" class="btn_blue4" onmouseover="$('#user_class').show();" onmouseout="$('#user_class').hide();">자세히보기</a></p>--}}
{{--                            전체 거래점수 (이전 3개월 거래점수 합계)--}}
{{--                            <div id="user_class" class="g_msgbox blue user_class">--}}
{{--                                <div class="title">전체 거래 점수란?</div>--}}
{{--                                <ul>--}}
{{--                                    <li>--}}
{{--                                        판매점수 및 구매점수를 합한 총점을 의미하며,<br>--}}
{{--                                        판매 완료건수 1건 = 판매점수 1점 / 구매 완료건수 1건 = 구매점수 1점이 됩니다.<br>--}}
{{--                                        <span class="f_org1">예)</span> 판매 완료건수 2건과 구매 완료건수 10건인 회원의 경우 전체 거래점수는 12점이 됩니다.--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <dl>--}}
{{--                                    <dt>▶ 이전 3개월 거래점수 합계 산출 방법</dt>--}}
{{--                                    <dd>--}}
{{--                                        이전 3개월 거래점수는 <span class="f_blue1">당월을 제외한 전월 포함 3개월간의 거래점수 합계</span>를 뜻합니다.<br>--}}
{{--                                        <span class="f_org1">예)</span> 8월의 경우 7월 / 6월 / 5월 의 거래점수 합계입니다.<br>--}}
{{--                                        [7월 (5점) + 6월 (3점) + 5월 (5점)] = 3개월 거래점수 합계 13점--}}
{{--                                    </dd>--}}
{{--                                </dl>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                    <ul>--}}
{{--                        <li>--}}
{{--                            <span class="SpGroup icon_sp"></span>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <p>쇼핑포인트 <a href="/myroom/pmall/spointmall.html" class="btn_blue4">포인트몰 바로가기</a></p>--}}
{{--                            신용등급에 따라 구매완료 시 수수료의 최대 5%가 구매자에게 적립 (단, 최저수수료 1,000원인 경우 고정 10p가 지급됩니다)<br>--}}
{{--                            쇼핑포인트는 모바일사이트 또는 모바일앱 &gt; 쇼핑포인트몰에서 상품권, 할인쿠폰, 구글기프트카드로 교환할수 있습니다.--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
            </div>
            <!-- ▼ 인증상태 //-->
            <div class="g_subtitle">인증상태</div>
            <div class="box6 cert_box">
                <span class="cert_state">우수인증</span>
                <span class="cert_state" onmouseover="$('#hppAuth').show();" onmouseout="$('#hppAuth').hide();" onclick="_window.open('mobile_certify', '/certify/ini_modi_authcenter/user_certify.html?cellNum=01047973690', 430, 700);">
            휴대폰
            <div id="hppAuth" class="certify">본인명의의 휴대폰 일 경우<br>인증이 가능합니다.</div>
         </span>
                <input type="hidden" id="user_email" value="jc5120@nate.com">
                <span class="cert_state" onmouseover="$('#emailAuth').show();" onmouseout="$('#emailAuth').hide();" onclick="fnemail();">
            이메일
            <div id="emailAuth" class="certify">이메일 인증이 가능합니다.</div>
         </span>
                <span class="cert_state on" onmouseover="$('#ipinAuth').show();" onmouseout="$('#ipinAuth').hide();">
            아이핀
            <div id="ipinAuth" class="certify">아이핀인증이 완료되었습니다.</div>
         </span>
                <span class="cert_state on" onmouseover="$('#acAuth').show();" onmouseout="$('#acAuth').hide();">
            출금계좌
            <div id="acAuth" class="certify">계좌인증이 완료되었습니다.</div>
         </span>
            </div>
            <form id="reqCBAForm" name="reqCBAForm" method="post" action="/certify/ipin_auth/v3/module/ipin_request.php" target="frmTarget">
                <input type="hidden" name="wis" value="MyAuthCredit">
            </form>
            <iframe src="about:blank" width="0" height="0" name="frmTarget" style="border:0"></iframe>
            <!-- ▼ 관리점수 //-->
            <div class="g_subtitle">관리점수</div>
            <ul class="admin_point">
                <li class="gray_bg">관리자 점수</li>
                <li>
                    <div class="g_left">
                        <span class="f_red1 f_bold">-50</span> 점
                        <span class="f_black1"> (불량거래 : 0건, 일시정지 : 5회)</span>
                    </div>
                    <div class="g_right">
                        <img src="http://img4.itemmania.com/images/btn/btn_det.gif" width="71" height="20" alt="상세내역" class="g_button" onclick="_window.open('admin_point', '/myroom/myinfo/admin_point.html', 560, 685);">
                    </div>
                </li>
            </ul>
            <div class="g_finish"></div>
            <!-- ▲ 관리점수 //-->
            <!-- ▼ 판매정보 보기 //-->
            <div class="g_subtitle">판매정보 보기</div>
            <table class="g_blue_table tb_list">
                <colgroup>
                    <col>
                    <col width="77">
                    <col width="77">
                    <col width="77">
                    <col width="77">
                    <col width="77">
                    <col width="77">
                    <col width="95">
                    <col width="95">
                </colgroup>
                <tbody>
                <tr>
                    <th class="f_blue3">총 판매 건수</th>
                    <td class="f_bold" colspan="3">796건</td>
                    <th class="f_blue3" colspan="2">총 판매 금액</th>
                    <td class="f_bold" colspan="3">95,796,820원</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="th2">05월</td>
                    <td class="th2">06월</td>
                    <td class="th2">07월</td>
                    <td class="th2">08월</td>
                    <td class="th2">09월</td>
                    <td class="th2">10월</td>
                    <td class="th2">이전 3개월</td>
                    <td class="th2">이전 6개월</td>
                </tr>
                <tr>
                    <td class="th2">판매건수</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;2</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;3</td>
                    <td>&nbsp;28</td>
                    <td>&nbsp;31</td>
                    <td>&nbsp;33</td>
                </tr>
                <tr>
                    <td class="th2">판매금액</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;6,000</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;664,200</td>
                    <td>&nbsp;9,445,600</td>
                    <td>&nbsp;10,109,800</td>
                    <td>&nbsp;10,115,800</td>
                </tr>
                <tr>
                    <td class="th2">취소/거부</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                </tr>
                </tbody>
            </table>
            <!-- ▲ 판매정보 보기 //-->
            <!-- ▼ 구매정보 보기 //-->
            <div class="g_subtitle">구매정보 보기</div>
            <table class="g_green_table tb_list">
                <colgroup>
                    <col>
                    <col width="77">
                    <col width="77">
                    <col width="77">
                    <col width="77">
                    <col width="77">
                    <col width="77">
                    <col width="95">
                    <col width="95">
                </colgroup>
                <tbody>
                <tr>
                    <th class="f_green2">총 구매 건수</th>
                    <td class="f_bold" colspan="3">112건</td>
                    <th class="f_green2" colspan="2">총 구매 금액</th>
                    <td class="f_bold" colspan="3">8,638,170원</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="th2">05월</td>
                    <td class="th2">06월</td>
                    <td class="th2">07월</td>
                    <td class="th2">08월</td>
                    <td class="th2">09월</td>
                    <td class="th2">10월</td>
                    <td class="th2">이전 3개월</td>
                    <td class="th2">이전 6개월</td>
                </tr>
                <tr>
                    <td class="th2">구매건수</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;1</td>
                    <td>&nbsp;8</td>
                    <td>&nbsp;9</td>
                    <td>&nbsp;9</td>
                </tr>
                <tr>
                    <td class="th2">구매금액</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;3,000</td>
                    <td>&nbsp;659,930</td>
                    <td>&nbsp;662,930</td>
                    <td>&nbsp;662,930</td>
                </tr>
                <tr>
                    <td class="th2">취소/거부</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                    <td>&nbsp;0</td>
                </tr>
                </tbody>
            </table>
            <!-- ▲ 구매정보 보기 //-->
            <!-- ▼ 알아두기 //-->
            <div class="g_notice">알아두기</div>
            <ul class="g_notice_box1 g_list">
                <li>거래 점수란 고객님의 판매 점수와 구매 점수를 합산한 점수를 뜻합니다.</li>
                <li class="list_non">(판매 완료 1건 = 판매 점수 1점 / 구매 완료 1건 = 구매 점수 1점)</li>
                <li>무료 이용권은 [발급받기] 버튼을 통해 정해진 수량만큼 발급 가능합니다.</li>
                <li>플래티넘 및 VIP 등급은 이전 3개월간 거래점수 조건을 충족한 경우 해당 등급에 산정됩니다.</li>
            </ul>
            <!-- ▲ 알아두기 //-->
        </div>
        <div id="safe_per_info" class="g_hidden">
            <span class="g_blue1_11">기업회원</span>의 경우 판매 물품에 대해<br>
            해킹신고 등 문제가 발생할 경우,<br>
            <span class="g_blue1_11">해당 문제 발생건에 대한 비율</span>을 산정합니다.<br>
            예를 들면, 판매내역 100건 중 1건의<br>
            거래가 문제 발생이 되었다면<br>
            <span class="g_org1_b">'안전거래율'은 99%</span>가 됩니다.<br>
            안전거래율은 기업회원의<br>
            판매내역에 대해서만 산출됩니다.
        </div>
        <form id="reloadFrm" name="reloadFrm" method="post">
        </form>
        <form name="ini" method="post">
            <input type="hidden" name="buyername" value="이장훈">
            <input type="hidden" name="mid" value="itemmani15">
            <input type="hidden" name="print_msg" value="">
            <input type="hidden" name="acceptmethod" value="">
            <input type="hidden" name="encrypted" value="">
            <input type="hidden" name="sessionkey" value="">
            <input type="hidden" name="cardcode" value="">
            <input type="hidden" name="paymethod" value="">
            <input type="hidden" name="uid" value="">
            <input type="hidden" name="version" value="4000">
            <input type="hidden" name="clickcontrol" value="">
            <input type="hidden" name="merchantreserved3" value="">
        </form>
        <form name="ini_pub" id="ini_pub" method="post">
            <input type="hidden" name="buyername" value="이장훈">
            <input type="hidden" name="INIregno" value="">
            <input type="hidden" name="acceptmethod" value="authreg">
            <input type="hidden" name="encrypted" value="">
            <input type="hidden" name="clickcontrol" value="">
            <input type="hidden" name="mid" value="itemmani15">
            <input type="hidden" name="key" value="">
            <input type="hidden" name="gopaymethod" value="PUB">
        </form>
        <div class="g_finish"></div>
    </div>
@endsection
