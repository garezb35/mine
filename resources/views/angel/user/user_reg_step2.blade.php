@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/user/join_agreement.css">
    <link type="text/css" rel="stylesheet" href="/angel/user/_join_title.css">

    <script type="text/javascript" src="/angel/carsouel_plugin/js/carsouel_plugin.js"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/user/join_agreement.js"></script>
@endsection

@section('content')
    <div @class('bg-white')>
        <div></div>
        <div @class('ml-10 mr-10')>
            <div class="recommend_e34rf">
            </div>
            <script type="text/javascript">
                var USER_TYPE = "general";
                window.name = 'joinAtFrm';	// 중요 아이핀 인증 시 꼭 필요
            </script>
            <style>
                .g_title_txt {
                    font-size: 24px;
                    font-weight: bold;
                    padding-top: 28px;
                    padding-bottom: 14px;
                }
                .g_title_txt span {
                    color: #0073DD;
                }
                .part-reg-step .div-each {
                    width: 25%;
                }
                .part-reg-step {
                    padding-bottom: 30px;
                }
                .part-reg-step .div-each {
                    background-color: #C4C4C4;
                    height: 140px;
                }
                .part-reg-step .active {
                    background-color: #3A79B4;
                }
                .part-reg-detail .part-text div {
                    color: white;
                    padding-top: 4px;
                }
                .part-reg-detail {
                    padding-left: 45px;
                    padding-top: 30px;
                }
                .part-reg-detail .part-text {
                    padding-top: 12px;
                    padding-left: 14px;
                    letter-spacing: 0px;
                }
                .part-reg-detail .img-part img {
                    display: inline-block;
                    height: 100%;
                    object-fit: contain;
                }
                .verify-type {
                    padding-top: 12px;
                }
                .verify-detail {
                    padding-top: 10px;
                }
                .user-verify-part {
                    padding-top: 40px;
                    margin-top: 20px;
                    margin-bottom: 60px;
                    border-top: solid 1px #a5a5a5;
                }
                #verify-phone, #verify-pin {
                    cursor: pointer;
                }
            </style>

            <div class="g_title_txt">
                <span>회원가입</span> 서비스
            </div>
            <div class="d-flex w-100 part-reg-step">
                <div class="div-each w-100 ">
                    <div class="d-flex part-reg-detail">
                        <div class="img-part">
                            <img src="/angel/img/icons/reg_step1.png" height="77" width="77" />
                        </div>
                        <div class="part-text">
                            <div class="f-15">STEP 01</div>
                            <div class="f-16">회원유형선택</div>
                        </div>
                    </div>
                </div>
                <div class="div-each w-100 active">
                    <div class="d-flex part-reg-detail">
                        <div class="img-part">
                            <img src="/angel/img/icons/reg_step2.png" height="63" width="74" styl />
                        </div>
                        <div class="part-text">
                            <div class="f-15">STEP 02</div>
                            <div class="f-16">약관동의</div>
                        </div>
                    </div>
                </div>
                <div class="div-each w-100">
                    <div class="d-flex part-reg-detail">
                        <div class="img-part">
                            <img src="/angel/img/icons/reg_step3.png" height="63" width="66" />
                        </div>
                        <div class="part-text">
                            <div class="f-15">STEP 03</div>
                            <div class="f-16">정보입력</div>
                        </div>
                    </div>
                </div>
                <div class="div-each w-100">
                    <div class="d-flex part-reg-detail">
                        <div class="img-part">
                            <img src="/angel/img/icons/reg_step4.png" height="70" width="85" />
                        </div>
                        <div class="part-text">
                            <div class="f-15">STEP 04</div>
                            <div class="f-16">회원가입완료</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="agree_check">
                <input type="checkbox" id="agreement_all" name="agreement_all">
                <label for="agreement_all">모든 약관을 확인하고 전체동의 합니다.<span>(전체 동의 시 선택항목도 포함됩니다.)</span></label>
            </div>

            <div class="agree_check_s">
                <input type="checkbox" id="user_agreement1" name="user_agreement1" value="1">
                <label for="user_agreement1">아이템천사 서비스 이용약관 및 아이템거래 서비스 이용약관에 동의합니다.
                    <span class="f_blue3">(필수)</span>
                </label>
            </div>

            <div class="clause_box">
                <ul class="sub_tab">
                    <li>
                        <a href="javascript:;" class="on" id="portal_tab">아이템천사 서비스 이용약관</a>
                    </li>
                    <li class="gb">|</li>
                    <li>
                        <a href="javascript:;" id="trade_tab">아이템거래 서비스 이용약관</a>
                    </li>
                </ul>
                <pre><div id="portal_yak">
제 1 장 총칙

제 1조 (목적)

   이 약관은 ㈜아이템천사(이하 "회사")가 제공하는 아이템천사 및 아이템천사 관련 제반 서비스 (이하 "서비스")의 이용조건 및 절차에 관한 회사와 회원간의 권리 의무 및 책임사항, 기타 필요한 사항을 규정함을 목적으로 합니다.

제 2 조 (약관의 명시, 설명과 개정)

   ① 이 약관의 내용은 회사의 서비스 회원가입 관련 사이트에 게시하거나 기타의 방법으로 사용자에게 공지 하고, 이용자가 회원으로 가입하면서 이 약관에 동의함으로써 효력이 발생합니다.
② 회사는 “약관의 규제에 관한 법률”, “정보통신망이용촉진 및 정보보호 등에 관한 법률” 등 관련법을 위배하지 않는 범위에서 이 약관을 개정할 수 있습니다.
③ 회사가 약관을 개정할 경우에는 적용일자 및 개정사유를 명시하여 현행약관과 함께 변경 후 약관을 회사 사이트의 초기화면이나 팝업화면 또는 공지사항란, 이메일 등을 통해 통상 그 적용일자 7일 이전에 공지 또는 통지합니다. 다만, 회원에게 불리한 내용으로 변경되는 경우에 한해서는 적용일자 30일 이전에 공지 또는 통지합니다.
④ 회사가 전항에 따라 개정약관을 공지 또는 통지하고, 회원이 그 기간 내에 명시적으로 거부의 의사표시를 하지 아니한 경우 개정약관에 동의한 것으로 봅니다.
⑤ 회원이 개정약관의 적용에 동의하지 않는 경우 회원은 이용계약을 해지할 수 있습니다. 다만, 기존 약관을 적용할 수 없는 특별한 사정이 있는 경우에는 회사는 이용계약을 해지할 수 있습니다.

제 3 조 (약관 외 준칙)

   이 약관에서 정하지 아니한 사항과 이 약관의 해석에 관하여는 전자상거래 등에서의 소비자보호에 관한 법률, 약관의 규제 등에 관한 법률, 공정거래위원회가 제정한 전자상거래 등에서의 소비자보호지침 및 관련 법령의 규정과 일반 상관례에 의합니다.

제 4 조 (용어의 정의)

이 약관에서 사용하는 용어의 정의는 다음과 같습니다.
① 회원 : 이 약관을 승인하고 회원가입을 하여 회사와 서비스이용계약을 체결한 자를 말합니다.
② 아이디(ID) : 회원의 식별과 서비스 이용을 위하여 회원이 회사가 승인한 문자와 숫자의 조합대로 설정한 것을 말합니다.
③ 홈페이지 : 회원이 회사의 서비스를 이용하게 하기 위하여 회사가 제공하는 아이템천사의 웹사이트를 말합니다.
④ 비밀번호 : 회원의 동일성 확인과 회원정보의 보호를 위하여 회원이 회사가 승인한 문자와 숫자의 조합대로 설정한 것을 말합니다.
⑤ 판매자 : 물품을 판매할 의사로 해당 물품을 회사가 온라인으로 제공하는 양식에 맞추어 등록하거나 신청한 회원을 말합니다.
⑥ 구매자 : 물품을 구매할 의사로 해당 물품을 회사가 온라인으로 제공하는 양식에 맞추어 등록하거나 신청한 회원을 말합니다.
⑦ 자율거래 : 물품을 전달하는 과정에서 회사의 참여 없이 판매자와 구매자가 서로 지정한 약속장소를 통해 거래하는 것을 말합니다.

제 2 장 서비스 이용 신청 및 승낙 (회원가입 및 탈퇴)

제 5 조 (이용계약의 성립)

① 이용자는 회사가 정한 가입 양식에 따라 회원정보를 기입한 후 이 약관에 동의한다는 의사표시를 함으로서 회원가입을 신청합니다.
② 회원가입은 회사의 승낙이 회원에게 도달한 시점으로 합니다.
③ 이용 계약은 회원ID 단위로 체결합니다. 이용계약이 성립되면, 이용신청자는 회원으로 등록됩니다.
④ 실명이 아니거나 타인의 이름, 생년월일, 주소, 전화번호 등의 개인정보를 도용하여 허위 가입한 회원은 법적인 보호를 받을 수 없으며, 이에 따른 민사, 형사상의 모든 책임은 가입한 회원이 져야 합니다.
⑤ 만 19세 미만은 아이템천사에서 제공하는 게임아이템거래관련 서비스이용이 제한 될 수 있습니다. 미성년자 회원이 유료컨텐츠를 이용하고자 하는 경우 법정대리인이 동의하지 않으면 본인 또는 법정대리인이 이를 취소 할 수 있습니다.
⑥ 제1항에 따른 신청에 있어 회사는 필요 시 관계법령에 의하여 이용자의 종류에 따라 전문기관을 통한 실명확인 및 본인인증을 요청할 수 있습니다. 만일, 이러한 회사의 제공 요청을 거부하여 이용자 본인임이 확인되지 않아 발생하게 되는 불이익에 대하여 회사는 책임을 지지 않습니다.
⑦ 회사는 회사의 책임있는 사유로 회원이 유료컨텐츠를 이용하는데 과오금이 발생한 경우 이용대금 결제와 동일한 방법으로 과오금을 환급합니다.
⑧ 회원은 유료컨텐츠의 내용이 표시·광고와 다르거나 계약내용과 다르게 이행된 경우 공급받은 날로부터 3월 이내, 그 사실을 안 날 또는 알 수 있었던 날로부터 30일 이내에 청약철회 등을 할 수 있습니다.

제 6 조 (이용신청)

① 이용신청은 온라인으로 회사 소정의 가입신청 양식에서 요구하는 사항을 기록하여 신청합니다.
② 온라인 가입신청 양식에 기재하는 모든 회원 정보는 실제 데이터인 것으로 간주하며 실명이나 실제 정보를 입력하지 않은 사용자는 법적인 보호를 받을 수 없으며, 서비스 사용의 제한을 받을 수 있습니다.
③ 사실과 다른 정보, 거짓 정보를 기입하거나 추후 그러한 정보임이 밝혀질 경우 회사는 서비스 이용을 일시 정지하거나 영구정지 및 이용 계약을 해지할 수 있습니다. 이로 인하여 회사 또는 제3자에게 발생한 손해는 해당 회원이 모든 책임을 집니다.
④ 회사는 회원에게 회사의 관련서비스에 대한 다양하고 유익한 정보를 E-mail, 서신우편, 전화 등을 통하여 제공할 수 있습니다.

제 7 조 (회원정보 사용에 대한 동의 및 이용신청의 승낙)

① 회원정보 사용에 대한 동의
1. 회사는 회원의 개인정보를 본 이용계약의 이행과 본 이용계약상의 서비스제공을 위한 목적으로 이용합니다.
2. 회원이 회사 및 회사와 제휴한 서비스들을 편리하게 이용할 수 있도록 하기 위해 회원 정보는 회사와 제휴한 업체에 제공될 수 있습니다. 단, 회사는 회원 정보 제공 이전에 제휴 업체, 제공 목적, 제공할 회원 정보의 내용 등을 사전에 공지하고 회원의 동의를 얻어야 합니다.
3. 회사는 이벤트 등 광고 알림 수신에 동의한 회원에게 해당 알림을 발송할 수 있으며, 회원은 언제든지 개인정보설정 메뉴에서 광고 알림의 수신 또는 거부로 변경할 수 있고, 회원의 명시적인 수신거부의사에 반하여 광고성 정보를 전송하지 않습니다.
4. 회원은 회원정보 수정을 통해 언제든지 개인 정보에 대한 열람 및 수정을 할 수 있습니다.
5. 회원이 이용신청서에 회원정보를 기재하고, 회사에 본 약관에 따라 이용신청을 하는 것은 회사가 본 약관에 따라 이용신청서에 기재된 회원정보를 수집, 이용 및 제공하는 것에 동의하는 것으로 간주됩니다.
② 이용신청의 승낙
1. 회사는 회원이 회사 소정의 가입신청 양식에서 요구하는 모든 사항을 정확히 기재하여 이용신청을 한 경우 회원가입을 승낙할 수 있습니다. 단, 제2호, 제3호의 경우는 회사는 승낙을 유보하거나 승낙을 거절할 수 있습니다.
2. 회사는 다음 각 호에 해당하는 이용신청에 대하여는 승낙을 유보할 수 있습니다.
가. 설비에 여유가 없는 경우
 나. 기술상 지장이 있는 경우
 다. 기타 회사의 사정상 이용승낙이 곤란한 경우
3. 회사는 다음 각 호에 해당하는 이용신청에 대하여는 이를 승낙하지 아니 할 수 있습니다.
가. 이름이 실명이 아닌 경우
 나. 다른 사람의 명의를 사용하여 신청한 경우
 다. 필요내용을 허위로 기재하여 신청한 경우
 라. 사회의 안녕질서 또는 미풍양속을 저해할 목적으로 신청한 경우
 마. 기타 회사가 정한 이용신청 요건이 미비되었을 때

제 8 조 (이용계약의 중지 및 해지)

① 이용계약은 회원 또는 회사의 해지에 의해 종료됩니다. 이용계약의 종료와 관련하여 발생한 손해는 이용계약이 종료된 해당 회원이 책임을 부담하여야 하고, 회사는 일체의 책임을 지지 않습니다.
② 회원이 이용계약을 해지하고자 할 때에는 회원 본인이 온라인을 통해 회사에 해지 신청을 하여야 하며, 회원의 회원 탈퇴 신청에 관한 처리는 다음 각호에 의합니다.
1. 회원은 회사에 언제든지 서비스 이용 해지를 요청할 수 있으며, 회사는 5일 후 이용 해지를 처리합니다. 다만, 해지 의사를 통지하기 전에 모든 상품의 판매 및 구매 절차를 완료, 철회 또는 취소해야만 합니다. 이 경우 판매 및 구매의 철회 또는 취소로 인한 불이익은 회원 본인이 부담하여야 합니다.
또한 해지 이후라도 서비스 이용 기간 중 회원 본인의 과실로 인해 타 회원 및 제3자에게 손해를 초래하였다면 이용 해지를 이유로 그 책임을 면할 수 없습니다.
2. 회원은 회사의 서비스를 이용함에 있어 거래분쟁 또는 사고 등이 발생하는 경우 분쟁해결 시까지 회원 탈퇴가 제한됩니다.
③ 회사는 회원이 다음 각 호의 어느 하나에 해당하는 행위를 하였을 경우 서비스 이용을 제한하거나 중지 또는 이용계약을 해지할 수 있습니다.
1. 타인의 서비스 ID 및 비밀번호를 도용한 경우
2. 서비스 운영을 고의로 방해한 경우
3. 가입한 이름이 실명이 아닌 경우 등 가입 신청 시에 허위 내용을 등록한 경우
4. 공공질서 및 미풍양속에 저해되는 내용을 고의로 유포시킨 경우
5. 회원이 국익 또는 사회적 공익을 저해할 목적으로 서비스이용을 계획 또는 실행하는 경우
6. 타인의 명예를 손상시키거나 불이익을 주는 행위를 한 경우
7. 서비스의 안정적 운영을 방해할 목적으로 다량의 정보를 전송하거나 광고성 정보를 전송하는 경우
8. 정보통신설비의 오작동이나 정보 등의 파괴를 유발시키는 컴퓨터 바이러스 프로그램 등을 유포하는 경우
9. 타인의 개인정보, 이용자ID 및 비밀번호로 부정하게 사용하는 경우
10. 회사의 서비스 정보를 이용하여 얻은 정보를 회사의 사전 승낙 없이 복제 또는 유통시키거나 상업적으로 이용하는 경우
11. 회원이 회사의 홈페이지와 게시판에 음란물을 게재하거나 음란사이트 링크하는 경우
12. 같은 사용자가 다른 ID로 이중등록을 한 경우
13. 회사, 다른 회원 또는 제3자의 지적재산권을 침해하는 경우
14. 방송통신심의위원회 등 외부기관의 시정요구가 있거나 불법선거운동과 관련하여 선거관리위원회의 유권해석을 받은 경우
15. 본 약관을 포함하여 기타 회사가 정한 이용조건에 위반한 경우
16. 장기간 휴면 가입자에 대하여 통지할 경우 그 통지 기간 내에도 서비스이용에 대한 의사표현을 하지 않은 경우
17. 거래 상대방 등 이용자에 대한 개인정보를 그 동의 없이, 수집, 저장, 공개하는 경우
18. 기타 회사의 서비스개선을 위한 회사 정책상 불가피할 경우
19. 운영자 또는 관리자가 이용에 부적합하다고 판단하는 경우
20. 범죄와 결부된다고 객관적으로 판단하는 행위
21. 기타 관계 법령에 위배되는 행위
④ 서비스 이용 중지 또는 제한 절차는 다음 각호에 의합니다.
1. 회사는 이용제한을 하고자 하는 경우에는 그 사유, 일시 및 기간을 정하여 서면 또는 전화, 홈페이지의 메시지 기능 등의 방법을 이용하여 해당 회원 또는
 대리인에게 통지합니다. 다만, 회사가 긴급하게 이용을 중지해야 할 필요가 있다고 인정하는 경우에는 이러한 과정 없이 서비스 이용을 제한할 수 있습니다.
2. 서비스 이용중지 통지를 받은 회원 또는 그 대리인은 서비스 이용중지에 대하여 이의가 있을 경우 이의 신청을 할 수 있습니다.
3. 회사는 이용중지 기간 중에 그 이용중지 사유가 해소된 것이 확인된 경우에 한하여 이용중지 조치를 즉시 해제합니다.
⑤ 이용계약 해지 절차는 다음 각호에 의합니다.
1. 회사가 서비스 이용을 중지 또는 제한 시킨 후 동일한 행위가 2회 이상 반복되거나 그 사유가 시정되지 아니하는 경우 또는 본조 제3항 각호의 위반행위가 있는
 경우 회사는 이용계약을 해지할 수 있습니다.
2. 회사가 이용계약을 해지하는 경우에는 회원등록을 말소합니다. 회사는 이 경우 회원에게 이를 통지하고, 회원등록 말소 전에 소명할 기회를 부여합니다.

제 9 조 (회원정보의 변경)

① 회원은 개인정보 수정화면을 통하여 언제든지 본인의 개인정보를 열람하고 수정할 수 있습니다. 다만, 서비스 관리를 위해 필요한 실명, 생년월일, 성별, 아이디 등은 수정이 불가능합니다.
② 회원은 회원가입 신청 시 기재한 사항이 변경되었을 경우 온라인으로 수정을 하거나 전자우편 기타 방법으로 회사에 대하여 그 변경사항을 알려야 합니다.
③ 전항의 변경사항을 회사에 알리지 않아 발생한 불이익에 대하여 회사는 책임지지 않습니다.

제 3 장 회원의 의무

제 10 조 (회원 아이디와 비밀번호 관리에 대한 회원의 의무)

① 아이디와 비밀번호에 관한 모든 관리책임은 회원에게 있습니다. 회원에게 부여된 아이디와 비밀번호의 관리소홀, 부정사용에 의하여 발생하는 모든 결과에 대한 책임은 회원에게 있습니다.
② 회원은 자신의 아이디가 부정하게 사용된 사실을 알게 될 경우 반드시 회사에 그 사실을 통지하고 회사의 안내에 따라야 합니다.
③ 제2항의 경우에 해당 회원이 회사에 그 사실을 통지하지 않거나, 통지한 경우에도 회사의 안내에 따르지 않아 발생한 불이익에 대하여 회사는 책임지지 않습니다.

제 11 조 (정보의 제공)

회사는 회원이 서비스 이용 중 필요가 있다고 인정되는 다음 각호과 같은 서비스 정보에 대해서 전자우편이나 서신우편 등의 방법으로 회원에게 제공할 수 있으며, 회원은 원치 않을 경우 가입신청메뉴와 회원정보수정 메뉴에서 정보수신거부를 할 수 있습니다.
1. 아이템거래 관련 서비스
2. 상품권몰 관련 서비스
3. 이벤트 및 행사관련 등의 서비스
4. 기타 회사가 수시로 결정하여 회원에게 제공하는 서비스

제 4 장 서비스 이용 총칙

제 12 조 (서비스의 종류)

① 회사에서 제공하는 서비스에는 아이템거래(판매관련, 구매관련, 상품 정보검색 관련 서비스), 상품권몰 서비스 등이 있습니다.
② 회사가 제공하는 서비스의 종류는 회사의 사정에 의하여 수시로 변경될 수 있습니다.


제 13 조 (서비스 내용의 공지 및 변경)

① 회사는 서비스의 종류에 따라 각 서비스의 특성, 절차 및 방법에 대한 사항을 서비스 화면을 통하여 공지하며, 회원은 회사가 공지한 각 서비스에 관한 사항을 이해하고 서비스를 이용해야 합니다.
② 회사는 서비스 내용이 변경되는 경우, 통상 변경 7일 이전에 공지하도록 하며, 회원이 공지 내용을 조회하지 않아 입은 손해에 대하여는 책임지지 않습니다.

제 14 조 (서비스의 유지 및 중지)

① 서비스의 이용은 회사의 업무상 또는 기술상 특별한 지장이 없는 한 연중무휴 1일 24시간을 원칙으로 합니다. 다만 정기 점검 등의 필요로 회사가 정한 날이나 시간은 그러하지 않습니다.
② 회사는 서비스를 일정범위로 분할하여 각 범위 별로 이용가능 시간을 별도로 정할 수 있습니다. 이 경우 그 내용을 사전에 공지합니다.
③ 회사는 다음 각 호에 해당하는 경우 서비스 제공을 중지할 수 있습니다.
1. 서비스용 설비의 보수 등 공사로 인한 부득이한 경우
2. 전기통신사업법에 규정된 기간통신사업자가 전기통신 서비스를 중지했을 경우
3. 회사가 직접 제공하는 서비스가 아닌 제휴업체 등의 제3자를 이용하여 제공하는 서비스의 경우 제휴업체 등의 제3자가 서비스를 중지했을 경우
4. 기타 불가항력적 사유가 있는 경우
④ 회사는 국가비상사태, 정전, 서비스 설비의 장애 또는 서비스 이용의 폭주 등으로 정상적인 서비스 이용에 지장이 있는 때에는 서비스의 전부 또는 일부를 제한하거나 정지할 수 있습니다.
⑤ 회사는 새로운 서비스로 교체 또는 기타 회사가 서비스를 제공할 수 없는 사유 발생시 제공되는 서비스를 중단할 수 있습니다.

제 15 조 (회원의 결제 이용 제한)

① 회사는 다음 각호에 해당하는 경우 회원의 결제 이용을 제한할 수 있습니다.
1. 월간 결제 이용금액이 과도한 경우
2. 판매자와 구매자가 동일인으로 판단되는 경우
3. 결제서비스 제공사 및 발행사의 요청이 있는 경우
4. 기타 회사의 운영정책상 결제 이용을 제한해야 하는 경우
② 위의 경우에 해당하는 경우 회사는 해당 내용을 회원에게 홈페이지의 메시지 등의 방법을 통해 알립니다.
③ 회사는 회원자격이 정지된 회원에 대해서도 해당 회원이 거래거부를 할 수 밖에 없었던 사유를 소명하거나, 거래상대방과의 합의가 있었음을 소명하는 경우 등에는 해당 회원의 신용점수 등 제반 사정을 감안하여 거부횟수의 전부 또는 일부를 차감함으로써 회원자격 정지조치를 해소할 수 있습니다.
④ 정지사유가 중복발생 시에는 모든 정지해제조건을 갖추었을 경우에 한해 해제 처리할 수 있습니다.

제 5 장 콘텐츠 서비스 이용관련

제 16 조 (상품권매장 서비스)

① 회사가 핀번호를 이용하여 상품권과 선불카드, 모바일 및 컨텐츠 서비스의 유료 상품을 회원에게 판매하는 서비스이며 아래 각 호와 같은 품목을 취급합니다.
1. 상품권 및 선불카드류
2. 모바일 서비스(충전요금제, 문자쿠폰 등)
3. 디지털 컨텐츠(웹하드, 음악, 영화, 만화 등)
4. 기타 회사가 정하는 품목
② 회사는 각 상품에 대한 핀번호를 제휴사로부터 구매 또는 발행받아 해당 상품을 구매한 회원에게 제공합니다.
③ 회원은 상품권매장 서비스 이용상의 모든 문의 및 문제에 대하여 각 상품을 취급하는 제휴사를 통하여 처리 할 수 있습니다. 단, 핀번호 이상유무에 대하여는 회사에 문의하여 처리 할 수 있습니다.
④회원은 마일리지를 사용하여 상품권, 선불카드류, 모바일 서비스의 관련 상품을 구매할 수 있습니다.
⑤ 회원은 원칙적으로 상품권매장 서비스 이용에 대한 환불 및 취소를 할 수 없습니다.

제 17 조 (마일리지)

① 마일리지란 회사에서 지정한 관련 서비스에서 사용되는 가상의 화폐를 지칭하며 1:1비율로 현금으로 환불이 가능합니다.
② 회사는 물품의 거래가 종료되었을 때 판매대금을 판매자에게 마일리지로 적립함을 원칙으로 합니다.
③ 회사는 이벤트 등으로 회원에게 임의적으로 마일리지를 부여 할 수 있습니다.
④ 전항에 의하여 부여된 마일리지는 회사 사정으로 인하여 마일리지 적용이 취소 될 수도 있습니다.
⑤ 본조 제3항에 의하여 부여된 마일리지에 대하여 회사는 현금 환불을 제한 또는 금지할 수 있습니다. 그 경우에도 구매를 위한 사용은 가능합니다.
⑥ 회원 탈퇴 시 또는 서비스 이용계약 해지 시 마일리지는 전액 환불 됨을 원칙으로 합니다. 단, PG수수료 등에 의해 잔여 마일리지가 2,000마일리지 이상인 경우에 환불이 가능하며, 환불이 가능한 계좌번호가 없을 시에는 마일리지는 삭제 될 수 있습니다.
⑦ 회원 탈퇴 시 또는 서비스 이용계약 해지 시 본조 제3항에 의하여 부여된 마일리지는 전액 삭제 됩니다.
⑧ 회사는 마일리지에 대한 금융이자 지급 의무가 없습니다.
⑨ 아이템천사 마일리지는 싸다프라이스의 마일리지와 통합적으로 운용됩니다. 다만, 아이템천사의 게임전용 마일리지 등 회사가 정한 일부 마일리지에는 적용되지 않습니다.
⑩ 본조 제3항에 따라 회사가 회원에게 부여한 마일리지 등을 제외하고, 회원이 충전한 마일리지의 사용 기간은 충전한 날로부터 5년입니다.

제 18 조 (쇼핑 POINT)

 ⑪ 회사는 물품 구매 또는 이벤트응모결과에 따라 쇼핑 POINT를 부여할 수 있습니다. 단, 적립방법이나 적립기준은 회사의 마케팅 정책의 변경에 따라 변경될 수 있습니다.
⑫ 쇼핑 POINT는 회사의 경영방침에 의하여 사용기간이 결정되며 혜택에 관한 제반사항 및 그 변경은 별도의 서비스 화면에 공지할 수 있습니다.
⑬ 회원 탈퇴 시 또는 서비스 이용계약 해지 시 회원에게 부여된 쇼핑 POINT는 모두 삭제됩니다.
⑭ 회사의 경영상·기술상의 이유로 쇼핑 POINT 서비스를 종료하는 경우 최소 30일전까지 회원에게 고지합니다.

제 6 장 개인 정보 보호

제 19 조 (회원정보 사용에 대한 동의)

① 회원의 개인 정보에 대해서는 회사의 개인정보 보호정책이 적용됩니다. 회원이 이용 신청서에 회원정보를 기재하고, 회사에 본 약관에 따라 이용 신청 하는 것은 회사가 본 약관에 따라 이용신청서에 기재된 회원정보를 수집, 이용 및 제공하는 것에 동의하는 것으로 간주 됩니다. 회원정보의 관리 책임자는 회사가 정하는 운영자입니다.
② 회원이 회사 및 회사와 제휴한 서비스들을 유용하고 편리하게 이용할 수 있도록 하기 위해 회사는 본 계약에 정해진 절차에 따라 회원 정보를 이용하거나 회사와 제휴한 업체에 제공할 수 있습니다. 단, 회사는 전기통신 기본법 등 법률의 규정에 의해 국가기관의 요구가 있는 경우, 범죄에 대한 수사상의 목적이 있거나 정보통신윤리위원회의 요청이 있는 경우 또는 기타 관계법령에서 정한 절차에 따른 요청이 있는 경우를 제외하고는 언제나 제휴 업체, 제공 목적, 제공할 회원 정보 내용 등을 사전에 공지하고 회원의 동의를 얻은 경우에 한하여 회원의 정보를 제3자에게 공개하거나 배포합니다. 단, 거래 시 거래가 정상적으로 성사 되어 쌍방 당사자간에 거래와 관련된 상호 정보를 교환하는 경우에는 본 조항의 제한이 적용되지 않습니다.
③ 이용 신청자 또는 회원이 이용 신청 시 기재한 신상정보가 변경 되었을 경우에는 즉시 운영자 또는 회원정보 변경 창을 통해서 관련사항을 수정하여야 합니다. 단, 회원 ID와 이름, 생년월일, 성별은 신용관리상 변경할 수 없습니다.
④ 전항의 경우, 수정하지 않은 정보로 인한 각종 손해는 당해 회원이 부담하며, 회사는 이에 대하여 아무런 책임을 지지 않습니다.
⑤ 회원이 회사의 개인정보 처리에 대해서 불만을 가질 경우 서면상으로 회사에 관련 내용을 제출하여야 하며 이 경우 회사는 적법한 절차에 따라 회원의 불만을 처리해야 합니다.
⑥ 회원의 이용 계약 해지는 제8조에 따르며, 이용계약이 해지된 경우 회원의 개인정보는 복구 및 재생할 수 없는 방법으로 파기합니다. 단 법령에서 달리 정하는 경우 그에 따라 처리합니다.
⑦ 회사는 전항에 의하여 개인정보를 파기하여야 할 의무가 있는 경우라도 상법 등 관계법령의 규정에 의하여 보존할 필요가 있는 경우에는 관계법령에서 정한 기간 동안 회원의 개인정보를 보관합니다.
1. 회원 가입 및 탈퇴를 반복하여 서비스를 부정 이용하는 사례를 방지하기 위하여 탈퇴한 이용자의 "최소한의 개인정보"를 복호화가 불가능한 일방향 암호화(해시 처리)하여 6개월간 보관합니다.
⑧ 특정 서비스 사용을 위해 개인정보를 수집하거나 전송할 필요가 있을 경우, 회사는 반드시 회원에게 이와 같은 사실을 사전 공지하고 회원의 동의를 구해야 합니다.
⑨ 회원이 제공한 개인정보는 회원의 동의 없이 목적 외의 이용으로 제공할 수 없습니다. 단, 다음 각호에 해당하는 경우에는 예외로 합니다.
1. 거래 진행을 위해 거래 당사자에게 정보를 제공하는 경우(성명, 전화번호, 연락처 등)
2. 물품 대금 결제와 수수료 청구를 위해 납부 대행사에 개인정보를 제공하는 경우
3. 법률적 증거자료로서 수사기관 등에 제공하는 경우(법적인 절차에 따라 제공할 수 있습니다.)
⑩ 회사가 제3자에게 개인정보를 제공할 경우에는 개인정보를 제공받은 제3자로 하여금 개인정보를 제공받은 목적을 달성할 때, 당해 개인정보를 지체 없이 파기합니다.
⑪ 회사는 서비스를 장기간(1년 또는 다른 법령에서 별도로 정한 기간, 회원이 달리 정한 기간) 동안 이용하지 아니하는 회원의 개인정보를 보호하기 위하여, 해당 기간 경과 후 다른 회원의 개인정보와 분리하여 별도 저장 관리하고 해당 회원의 서비스 이용을 제한 할 수 있습니다. 단, 회원이 서비스 이용의사를 표시한 경우 즉시 서비스 이용이 가능합니다.

제 7 장 손해배상 및 면책조항

제 20 조 (손해배상)

회사는 본 약관에서 규정한 매매 규칙을 벗어난 거래를 통해서 발생한 일체의 사고에 대해서 책임을 지지 않으며, 판매자 또는 구매자의 과실로 인해 발생한 분쟁에 대해서 책임을 지지 않습니다. 회사의 제휴사에 의해 발생한 피해는 제휴사의 약관에 준하며, 제휴사와 회원 사이에 분쟁 해결하는 것을 원칙으로 합니다.

제 21 조 (면책조항)

① 회사는 다음 각 호에 해당하는 경우에는 책임을 지지 않습니다.
1. 전시, 사변, 천재지변 또는 이에 준하는 국가 비상 사태 등 불가항력적인 경우
2. 이용자의 고의 또는 과실로 인하여 손해가 발생한 경우
3. 전기통신사업법에 의한 타 기간 통신사업자가 제공하는 전기통신서비스 장애로 인한 경우
② 회사는 이용자의 귀책 사유로 인한 서비스 이용의 장애에 대하여 책임을 지지 아니합니다.
③회사는 이용자의 게시 또는 전송한 자료의 내용에 관하여는 책임을 지지 아니 합니다
④ 회사는 게임개발 업체 또는 게임 서비스 업체의 서비스 불량으로 인한 또는 정기적인 서버 점검 시간으로 인하여 물품전달에 하자가 발생하였을 경우는 책임을 지지 않습니다.
⑤ 아이템천사에 등록된 물품의 내용은 각 회원이 등록한 것으로 회사는 등록내용에 대한 일체의 책임을 지지 않습니다.

제 22 조 (대리 및 보증의 부인)

① 회사는 물품을 판매하거나 구매하고자 하는 회원을 대리할 권한을 갖고 있지 않으며, 회사의 어떠한 행위도 판매자 또는 구매자의 대리 행위로 간주되지 않습니다.
② 회사는 회사가 제공하는 서비스를 통하여 이루어지는 회원간의 판매 및 구매와 관련하여 판매의사 또는 구매의사의 사실 및 진위, 적법성에 대하여 보증하지 않습니다.
③ 회사는 회사에 링크된 사이트가 취급하는 상품 또는 용역에 대하여 보증책임을 지지 아니합니다. 회사와 회사에 연결된 사이트는 독자적으로 운영되며 회사는 회사 연결사이트와 회원간에 행해진 거래에 대하여 어떠한 책임도 지지 아니합니다.

제 23 조 (관할법원 및 준거법)

① 회사의 요금체계 등 서비스 이용과 관련하여 분쟁이 발생될 경우, 회사의 본사 소재지를 관할하는 법원을 관할 법원으로 하여 이를 해결합니다.
② 서비스 이용과 관련하여 회사와 회원 간의 소송에는 대한민국 법을 적용합니다.

제 24 조 (기타)
회사는 회원이 제기하는 정당한 의견이나 불만을 반영하고 그 피해를 보상처리하기 위하여 고객감동센터를 설치하고 운영합니다.

[(부칙)]
1. 이 약관은 2020년 5월 1일부터 적용됩니다.
2. 2018년 10월 15일부터 시행되던 종전의 약관은 본 약관으로 대체됩니다.</div><div id="trade_yak" style="display:none">
제 1 조 (목적)

이 약관은 ㈜아이템천사(이하 "회사"라고 합니다)가 운영하는 물품게시판을 통하여 제공하는 아이템거래 관련 서비스(이하 "서비스"라고 합니다)를 이용함에 있어 회사와 회원과의 권리ㆍ의무 및 책임사항을 정하는 것을 목적으로 합니다.

제 2 조 (정의)

① "서비스"라 함은 회사가 제공하는 아이템거래 중개서비스 및 이와 관련한 제반 서비스를 말합니다.
② 판매자 : 물품을 판매할 의사로 해당 물품을 회사가 온라인으로 제공하는 양식에 맞추어 등록하거나 신청한 회원을 말합니다.
③ 구매자 : 물품을 구매할 의사로 해당 물품을 회사가 온라인으로 제공하는 양식에 맞추어 등록하거나 신청한 회원을 말합니다.
④ 자율거래 : 물품을 전달하는 과정에서 회사의 참여 없이 판매자와 구매자가 서로 지정한 약속장소를 통해 거래하는 것을 말합니다.

제 3 조 (약관의 명시와 설명 및 개정)

① 이 약관 외 사항은  이용약관을 준용합니다.
② 회사가 이 약관을 개정할 경우에는 적용일자 및 개정사유를 명시하여 현행약관과 함께 변경 후 약관을 회사 사이트의 초기화면이나 팝업화면 또는 공지사항란, 이메일 등을 통해 통상 그 적용일자 7일 이전에 공지 또는 통지합니다. 다만, 회원에게 불리한 내용으로 변경되는 경우에 한해서는 적용일자 30일 이전에 공지 또는 통지합니다.
③ 회사가 전항에 따라 개정약관을 공지 또는 통지하고, 회원이 그 기간 내에 명시적인 거부의 의사표시를 하지 아니한 경우 개정약관에 동의한 것으로 봅니다.
④ 회원이 개정약관의 적용에 동의하지 않는 경우 회원은 이용계약을 해지할 수 있습니다. 다만, 기존 약관을 적용할 수 없는 특별한 사정이 있는 경우에는 회사는 이용계약을 해지할 수 있습니다.

제 4 조 (서비스의 제공)

① '회사'가 제공하는 '서비스'는 다음과 같습니다.
1. 아이템거래(판매관련, 구매관련, 상품 정보검색 관련 서비스)
2. 자율거래 지원 서비스
3. '상품' 정보검색서비스 및 마케팅 프로모션/ 광고 서비스
4. 기타 '회사'가 정하는 업무
② '회사'는 원활하고 편리한 '서비스'를 위한 시스템을 운영 및 관리하며 '이용자' 사이에 성립된 거래 및 '이용자'가 제공하고 등록한 정보에 대해서는 해당 '이용자'가 그에 대한 직접적인 책임을 부담하여야 합니다. 이와 관련해서 '회사'는 어떠한 책임도 지지 않습니다.

제 5 조 (서비스이용)

① 이용자는 이 약관에 동의한다는 의사표시를 함으로써 서비스 이용을 신청합니다.
② 회사는 전항과 같이 회원의 이용 신청에 있어 다음 각 호에 해당하는 경우 승낙을 거절할 수 있습니다.
1. 가입 신청자가 이 약관 제6조 제2항에 의하여 이전에 회원자격을 상실한 적이 있는 경우. 다만 회원자격 상실 후 1년이 경과한 자로서 회사의 회원 재가입 승낙을 얻은 경우에는 예외로 한다.
2. 등록 내용에 허위, 기재누락, 오기 등이 있는 경우
3. 기타 회원으로 등록하는 것이 회사의 기술상 현저히 지장이 있다고 판단되는 경우
4. 만19세 미만의 아동 및 청소년보호법 상의 청소년
③ 회원은 개인정보 항목의 등록사항에 변경이 있는 경우, 즉시 전자우편 기타 방법으로 회사에 그 변경사항을 알려야 합니다.
④ 회사는 회원에 대하여 청소년보호법 등 관련 법령에 따른 등급 및 연령 준수를 위한 서비스 별 이용제한을 할 수 있습니다.

제 6 조 (이용 해지 및 자격 상실 등)

① 회원은 회사에 언제든지 서비스 이용 해지를 요청할 수 있으며 회사는 5일 후 이용 해지를 처리합니다. 다만, 해지 의사를 통지하기 전에 모든 상품의 판매 및 구매 절차를 완료, 철회 또는 취소해야만 합니다. 이 경우 판매 및 구매의 철회 또는 취소로 인한 불이익은 회원 본인이 부담하여야 합니다. 또한 해지 이후라도 서비스 이용 기간 중 회원 본인의 과실로 인해 타 회원 및 제3자에게 손해를 초래하였다면 이용 해지를 이유로 그 책임을 면할 수 없습니다.
② 회원이 다음 각 호의 사유에 해당하는 경우, 회사는 회원의 이용자격을 제한 및 정지시킬 수 있습니다.
1. 가입 신청 시에 허위 내용을 등록한 경우
2. 회사의 서비스 이용과 관련하여 회원이 부담하는 채무를 기일에 지급하지 않는 경우
3. 타인의 서비스 이용을 방해하거나 타인의 정보를 도용하는 등 전자상거래 질서를 위협하는 경우
4. 회사가 제공하는 서비스를 방해하는 행위를 하거나 시도하는 경우
5. 회사를 이용하여 법령과 본 약관이 금지하거나 공서양속에 반하는 행위를 하는 경우
6. 타인의 개인정보를 도용 및 임의사용 하거나 연락처의 허위/도용 또는 고의로 회사, 판/구매자와의 연락을 두절하는 경우
7. 기타 회사의 영업행위를 고의로 방해하는 경우
8. 기타 회사의 합리적 판단에 의하여 회원의 서비스 이용 행위가 회사에 중대한 피해를 입힐 우려가 있다고 판단되는 경우
9. 회원이 이 약관 제9조 제8항 제1호가 정하고 있는 매매부적합상품을 판매등록하거나, 기타 공공질서 및 미풍양속에 위배되는 상품거래행위를 하거나 시도한 경우
10. 회원이 실제로 물품을 판매하고자 하는 의사 없이 물품등록을 한 경우 또는 구매의사 없이 회원의 물품에 구매 신청한 후 구매를 거부하는 경우
11. 회사의 서비스 정보를 통하여 얻은 정보로 직거래를 유도하는 경우
12. 타인의 개인정보를 도용 및 임의사용 하거나 연락처의 허위/도용 또는 고의로 회사, 판/구매자와의 연락을 두절하는 경우
13. 거래 상대방 등 이용자에 대한 개인정보를 그 동의 없이 수집, 저장, 공개하는 경우
14. 복제품이나 해킹물품, 또는 판매목적이 아닌 물품을 등록하는 경우
15. 기타 회사의 서비스개선을 위한 회사 정책상 불가피할 경우
③ 회사가 회원 자격을 제한 및 정지시킨 후, 동일한 행위가 2회 이상 반복되거나 그 사유가 시정되지 아니하는 경우 회사는 회원자격을 상실시킬 수 있습니다.

제 7 조 (거래점수/신용등급)

① 회사는 서비스를 통한 거래의 안전성과 신뢰성을 위하여 회원에게 거래점수를 부과합니다.
② 회원에게 부과된 거래점수는 이용자의 신용등급을 구분하는 기준이 되며 신용등급은 VIP, 플래티넘, 골드, 실버, 일반 등급으로 구분됩니다.
③ 회원가입 후 초기에 부여되는 거래점수는 0점이며 일반등급입니다.
④ 거래점수의 부여기준은 아래와 같습니다.
1. 물품판매에 따른 부과 판매 1건당 거래점수가 1점 상승합니다.
2. 물품구매에 따른 부과 구매 1건당 거래점수가 1점 상승합니다.
⑤ 일부 등급에는 거래점수 이외에 필요한 조건이 있습니다.
⑥ 거래점수 및 신용등급은 항시 공개할 수 있습니다.
⑦ 거래점수 및 신용등급의 운영정책은 회사가 따로 정하는 바에 의합니다.

제 8 조 (벌점)

① 회사는 다음 각호의 사유로 인하여 판매자와 구매자에게 벌점을 부과할 수 있습니다.
1. 비정상적인 거래 진행
2. 판매거부
3. 구매거부
4. 기타 회사의 판단
② 벌점 부과 내역 및 벌점 현황 등 벌점과 관련된 내용은 회원의 거래 안전을 위하여 홈페이지 등에 공개할 수 있습니다.

제 9 조 (물품등록/구매등록)

① 회사가 제공하는 서비스를 통하여 물품을 판매 또는 구매하고자 하는 회원은 회사가 제공하는 물품등록 양식에 따라 물품을 등록하여야 합니다.
② 판매 또는 구매를 목적으로 제출한 물품에 대한 설명에는 거짓이 없어야 하며, 회사가 정하는 양식에 어긋난 등록이나 허위등록으로 인한 손해 또는 손실에 대한 책임은 회원이 부담해야 합니다.
③ 팔고자 하는 물품에 대하여 정확한 정보를 양식에 맞게 작성하여야 합니다.
④ 회사에서 제공하는 거래방법은 '자율거래'입니다. 단, 회원은 안전한 거래를 위하여 본 약관 상의 판매자 및 구매자의 의무를 준수하여야 합니다.
⑤ 자율거래를 할 때 물품을 전달하거나 인수 시에 발생되는 사고에 대해서는 회사는 일체 책임지지 않습니다.
⑥ '등록 후'의 물품대금 결제수단으로 ‘마일리지’, ‘신용카드’, ‘휴대폰’ ‘기타의 방법’ 중 선택하여 결제하도록 하고 있습니다.
⑦ 물품판매 대금을 송금 받을 수 있는 '출금계좌정보(예금주, 은행명, 계좌 번호 등)'를 정확하게 입력하셔야 하며, '출금계좌정보'의 예금주는 판매자의 성명과 동일 하여야 합니다. 판매자의 성명과 동일하지 않을 경우 회사에서는 출금을 보류합니다.
⑧ 물품 등록 및 판매의 제한(매매불가 물품)
법률상 소유가 금지되어 있거나, 거래가 금지되어 있는 물품, 불법 개인정보 거래, 불법 사설서버 거래, 소프트웨어 OEM 제품, 복제품, 장물, 홍보용 무료 또는 할인 상품권, 습득물, 관련법령에 의하여 제작, 유통, 판매가 금지된 성인물, 허가번호 없이 불법 복제된 성인물 및 소프트웨어, 군 형법에 저촉되는 군용품(군복, 대검, 망원경 등), 회원으로부터 신고가 접수되어 회사가 불법물건으로 판단한 물품, 기타 회사가 풍속을 해치거나 판매가 불가능하다고 판단되는 물품은 거래하실 수 없습니다.
⑨ 부가서비스의 이용
 물품을 판매하고자 하는 회원은 물품등록 시 보다 효과적인 판매를 위하여 회사가 제공하는 부가 서비스를 신청할 수 있습니다. 부가서비스의 구체적인 내용에 대해서는 회사가 따로 정하는 바에 의합니다. 단, 전항에 의하여 회사가 제한하는 물품의 등록, 거래 등의 행위가 있는 경우 부가서비스에 따른 이용요금은 환불되지 않습니다.
⑩ 물품등록정보의 수정
1. 등록된 물품정보를 추가하거나 등록된 물품 사진은 거래진행 후에는 변경할 수 없습니다.
2. 물품 등록시 신청한 부가서비스의 취소는 불가능하며 추가만이 가능합니다.
⑪ 계약의 성립
1. 판매자가 등록한 물품에 대하여 구매자가 구매신청 후 해당 대금을 회사에 결제한 경우 물품에 대한 계약이 성립한 것으로 봅니다.
2. 구매자가 등록한 물품에 대하여 판매자가 판매신청을 한 후 구매자가 해당 대금을 회사에 결제한 경우 물품에 대한 계약이 성립한 것으로 봅니다.
⑫ 판매자의 의무와 책임
1. 등록한 물품에 대해서는 입금완료한 구매자에게 판매할 의무가 있으며, 이를 어길 시에는 제8조에서 규정한 판매거부 벌점이 적용됩니다.
2. 판매자는 물품 등록 정보에 대한 회원들의 문의에 대해 성실히 답변해 주어야 합니다. 불충분한 설명으로 인한 반품 등의 피해는 판매자의 책임입니다.
3. 판매자는 본인이 등록(판매)한 물품이 해킹 및 사기아이템이거나 매매가 금지된 물품일 경우 이에 대한 모든 민∙형사상의 책임을 집니다.

제 10 조 (거래진행)

① 구매자 통보
1. 구매자는 구매하고자 하는 물품을 선택한 후 회사가 정한 시간안에 회사에 입금을 해야 하며, 입금 시에는 회사가 원하는 입금정보를 기재하셔야 합니다.
2. 현금 결제 시 입금에 대한 입금수수료 또는 PG사의 결제수수료(구매자가 물품대금을 회사로 입금하면서 발생하는 은행 입금수수료 또는 PG를 이용한 충전 시
 발생하는 수수료)는 구매자가 구매금액을 회사에 입금할때 회원이 부담해야 하며, 절대로 환불되지 않습니다.
② 판매자의 물품 전달
1. 회사로부터 구매자의 입금 확인 및 물품 인계요청 통지를 받은 판매자는 구매자에게 물품을 안전하게 인계할 의무가 있습니다.
2. 회사로부터 물품 전달 요청 통지를 받은 판매자는 구매자에게 물품을 전달해야 합니다. 단, 판매자는 구매자로부터 거래취소 요청이 있는 경우 구매자와
 합의하여야 하며, 판매자가 입력한 핸드폰번호 및 집 전화번호로 연락이 되지 않는 경우 해당 거래는 자동으로 취소될 수 있습니다.
3. 거래 진행 시 판매자와 구매자는 거래일시, 거래장소, 거래방법 등을 협의하는 경우에는 회사가 제공한 상호 간의 연락처 또는 1:1 대화함을 이용하여야 하며,
회사가 제공하지 아니한 다른 수단 또는 거래 상대방이 아닌 제3자 간 협의로 인하여 발생하는 문제에 대해 회사는 책임을 지지 않습니다.
4. 판매자가 물품 전달을 하지 않아 발생하는 손해에 대한 모든 책임은 판매자가 책임져야 합니다.
5. 판매자의 물품 전달 지연에 대하여 회사는 아무런 책임이 없으며 물품 전달 지연으로 인하여 구매자에게 피해를 주었을 경우 판매자가 책임집니다.
6. 판매자가 물품을 전달하였음에도 불구하고, 게임 개발 서비스 업체의 서비스 이상으로 구매자가 물품을 전달 받지 못한 경우, 구매자는 즉시 회사로 판매자에 대한
 대금지급 중지신청을 하여야 합니다. 구매자가 대금지급 중지신청을 하지 않거나 회사가 대금지급을 한 후에 중지신청을 한 경우에, 회사는 입금된 거래액에 대해서
 책임을 지지 않습니다.
7. 물품의 전달 확인 : 판매자와 구매자는 ‘마이룸’을 통하여 물품의 인계확인과 인수확인을 하여야 하고, 구매자가 물품 인수확인을 하지 않을 경우 회사에서는 판매자에 대한 대금지급을 보류할 수 있습니다.
④ 물품대금의 판매자 송금
1. 물품을 전달받은 구매자가 [물품인수 확인] 버튼을 클릭하여 물품수령을 회사로 통보한 경우, 회사는 거래금액에서 제18조에서 규정한 수수료 및 기타 미납
 수수료를 제외한 금액을 판매자에게 적립합니다.
2. 구매자의 인수확인 지연으로 인한 적립지연에 대하여 회사는 아무 책임이 없으며 구매자가 책임집니다.
3. 회사 서비스를 이용하는 과정에서 회사가 취득하게 되는 이자 수입은 회사가 물품대금 결제를 위한 서비스를 제공하는 대가로서의 성질을 가지며, 회원은 이에 대한 반환을 청구할 수 없습니다.
⑤ 반품과 환불
1. 회사가 판매자에게 물품대금을 지급하기 전이면, 구매자는 수령한 물품에 대한 환불을 회사에 요청할 수 있습니다. 다만, 회사는 환불에 대하여 판매자의 동의가
 있는 경우에만 구매자에게 환불절차를 진행합니다.
2. 판매자는 정당한 반품 요구를 들어줄 의무가 있습니다. 단, 구매자가 '인수확인'을 클릭하여 판매자에게 물품대금이 회사로부터 송금된 후에는 회사는 반품 및 환불
 과정에 일체 관여하지 않고 거래당사자와 협의로 진행합니다.
3. 구매자가 반품을 하려면 사전에 판매자와 연락을 취하여 서로 합의하여야 하며 회사는 이에 대하여 관여하지 않고 판매자와 구매자 쌍방이 개별적으로
 해결하여야 합니다.
4. 물품을 반품하고자 하는 경우, 구매자는 물품을 판매자에게 이상 없이 전달하여야 하며 구매자의 물품전달과 관련하여 회사는 아무런 책임이 없습니다.
⑥ 구매자의 의무
1. 구매자는 물품에 대하여 구매의사를 밝혔을 경우 물품대금을 결제하여야 합니다.
2. 마일리지 결제의 경우 구매금액을 회사가 지정하는 방법으로 충전 후 결제를 완료 하여야 합니다.
3. 신용카드 결제와 휴대폰 결제의 경우 회사가 지정한 온라인 결제 대행업체(PG사)를 통하여 결제를 하여야 합니다.
4. 판매자가 판매거부 시 구매자는 즉시 회사에 해당사실을 통보하여야 합니다. 이때 제 8조에 의거하여 판매자에게 벌점이 적용됩니다.
5. 판매자가 판 물품에 하자가 있거나 물품 등록 정보와 현저히 다를 경우 구매자는 정당하게 구매를 취소할 수 있으며 회사는 이로 인해 구매거부 벌점을 부여하지못합니다. 단, 판매자에게는 제 8조에 의거하여 벌점이 적용됩니다.⑦ 판매자의 의무
1. 판매자는 구매자의 입금여부 및 구매자 거래정보를 정확히 확인 후 물품을 전달해야 합니다.
2. 구매자가 정당한 사유 없이 구매거부 시 판매자는 즉시 회사에 해당사실을 통보하여야 합니다. 이때 제 8조에 의거하여 구매자에게 벌점이 적용됩니다.
3. 판매자의 판매 취소는 회사로부터 대금 지급받기 이전까지 가능하나, 제8조에 의거하여 벌점이 적용될 수 있습니다. 다만, 회사가 대금을 판매자에게 지급한
 이후에는 판매취소를 할 수 없습니다.
4. 구매자의 정당한 구매취소 및 반품에 대하여 판매자는 이를 들어줄 의무가 있습니다.

제 11 조 (구매거부 / 판매거부의 신고, 신청 및 처리 절차)

① 구매자와 판매자는 거래 마감 후 거래 상대방의 구매거부, 판매거부 행위를 회사에 신고할 수 있습니다.
② 판매 취소 요청 또는 구매거부에 따른 신고가 회사에 접수된 경우 판매자 또는 구매자는 신고된 내용에 대해 의견을 진술할 기회가 있고, 신고 접수 후 의견 진술이 없을 경우 회사는 상대방의 신고 내용을 인정하는 것으로 간주하고 거래 종료할 수 있으며, 상대방의 신고에 대하여 의견진술을 한 경우는 회사가 판단하여 제8조에 의거하여 벌점을 부과할 수 있습니다.
③ 구매자와 판매자가 모두 구매거부와 판매거부를 신청한 경우에는 등록된 물품에 대한 거래가 취소됩니다.
④ 판매취소 신고 요건은 다음과 같습니다.
1. 구매자가 정당한 이유없이 구매거부 의사를 밝혔을 경우
2. 입금확인 후 구매자와 연락이 되지 않거나 연락처 정보가 불량인 경우
3. 구매자가 정해진 시간 안에 입금하지 않거나 입금 마감일이 지났을 경우
4. 구매자가 판매자가 제시한 거래방법에 합의하고도 그에 따른 거래를 하지 않을 경우
⑤ 구매취소 신고 요건은 다음과 같습니다.
1. 판매자가 판매거부 의사를 밝혔을 경우
2. 입금확인 후 판매자와 연락이 되지 않거나 연락처 정보가 불량인 경우
3. 판매자가 물품 전달을 약속한 후 물품을 전달하지 않는 경우
4. 판매자가 물품 등록시 선택한 것과 다른 거래 방법을 강요할 경우
5. 판매자가 제시한 거래방법에 대하여 합의되었는데도, 판매자가 다른 거래방법을 제시하는 경우

제 12 조 (구매안전서비스)

① 회사는 구매자가 지급하는 결제대금을 예치하고 거래완료 후 물품대금을 판매자에게 지급함으로써 구매자의 안전을 도모합니다.
② 회사는 판매자가 [인계확인]을 하였음에도 구매자가 [인수확인]을 하지 않아 판매자로부터 이에 대한 이의제기 등을 받게 될 경우 구매자에게 이러한 사실을 통지 후 24시간 후에 판매자에게 물품대금을 지급할 수 있습니다. 다만, 회사가 판매자에게 결제대금을 지급하기 이전에 구매자가 이의를 제기한 경우에는 그 지급을 보류할 수 있습니다.
③ 거래의 자동종료
1. 이 약관 제18조 제11항에 따라 계약이 성립되어 구매자가 인수확인, 취소, 환불 등에 관한 의사표시를 해야함에도 이에 대한 의사표시가 없을 시 회사는 구매자에게 이러한 사실을 통지하고, 구매자에게 의사표시를 요청합니다. 이 때 회사의 통지 발송일로부터 24시간 이내에도 구매자의 의사표시가 없는 경우 회사는 구매자에게 인수확인 의사가 있는 것으로 간주하여 자동인수확인을 할 수 있습니다.
2. 자동인수확인이 이루어진 경우 구매자는 물품의 미수령 또는 취소, 반품, 환불 등의 사유로 회사에 대하여 이의를 제기할 수 없으며, 판매자와 구매자 쌍방이 개별적으로 해결하여야 합니다.
3. 회사는 원활하고 편리한 ‘서비스’를 위한 시스템을 운영 및 관리하며, ‘이용자’ 사이에 성립된 거래 및 ‘이용자’가 제공하고 등록한 정보에 대해서는 해당 ‘이용자’가 그에 대한 직접적인 책임을 부담하여야 합니다. 이와 관련해서 ‘회사’는 어떠한 책임도 지지 않습니다.

제 13 조 (아이템거래 서비스 이용제한)
<table class="table-primary tb_list">
<colgroup>
    <col width="143">
    <col width="360">
    <col width="126">
    <col width="126">
</colgroup>
<tbody><tr>
    <th>구분</th>
    <th>정지사유</th>
    <th>해제조건</th>
    <th>정지효력</th>
</tr>
<tr>
    <td>
        서비스 제한
        (로그인 外 서비스
        이용 불가)
    </td>
    <td>
        - 명의(연락처) 미확인
        - 해킹/사기 사고 발생
        - 사고회원 관련자(연락처 및 개인정보 일치)
        - 상습적인 비거래 물품 등록
        - 결제보안 연속 5회 오류
        - 탈퇴 신청
        - 기타 : 관리자 판단(정상적인 서비스 진행에 심각한 장애 유발 시)
    </td>
    <td>
        - 정지 사유 해결
        - 관리자 판단
    </td>
    <td>
        로그인 이외의
        거래, 충전, 출금 불가
    </td>
</tr>
<tr>
    <td>로그인 제한</td>
    <td>
        - 비밀번호 연속 5회 오류
        - 해킹/사기 사고 발생
        - 명의도용으로 의심되는 경우
        - 기타 : 관리자 판단
    </td>
    <td>
        - 정지 사유 해결
        - 관리자 판단
    </td>
    <td>로그인 불가</td>
</tr>
<tr>
    <td>
        일부 서비스 제한
        (구매, 판매, 송금 제한)
    </td>
    <td>
        관리자 판단에 따라 구매/판매/송금 등 특정 서비스 外 이용은 문제
        없다고 판단될 경우 부분 제한으로 처리할 수 있음.
    </td>
    <td>
        - 정지 사유 해결
        - 관리자 판단
    </td>
    <td>특정 서비스 이용불가</td>
</tr>
</tbody></table>

제 14 조 (책임제한)

① 회사는 천재지변 또는 이에 준하는 불가항력으로 인하여 서비스를 제공할 수 없는 경우 서비스 제공에 관한 책임이 면제됩니다.
② 회사는 회원의 귀책사유로 인한 서비스 이용의 장애에 있어 책임을 지지 않습니다.
③ 회사는 서비스의 환경만을 제공하고 효율적 시스템 운영 및 관리 책임만을 부담하며 기타 부가정보를 제공함에 그치는 것으로 회원간 거래 진행, 물품배송, 청약철회 또는 반품, 물품하자로 인한 분쟁해결 등 필요한 사후처리는 거래당사자인 회원이 직접 수행하여야 합니다. 회사는 이에 대하여 원칙적으로 관여하지 않으며 어떠한 책임도 부담하지 않습니다.
④ 회사의 서비스를 통하여 이루어지는 회원간 거래행위와 관련하여 거래 의사의 여부 및 진정성, 게시된 상품의 품질, 완전성, 안전성, 적법성 및 여타의 권리관계에 대한 비 침해성, 회원간 입력한 정보 및 그 정보를 통하여 링크된 Website 게시물의 진실성 등에 대한 보증을 하지 아니하며, 그와 관련된 일체의 책임과 위험은 게시한 회원이 부담합니다.
⑤ 회사의 서비스는 회원의 자기결정에 의하여 회원 상호간 거래가 이루어질 수 있도록 사이버 거래장소를 제공하는 즉 전자상거래 등에서의 소비자보호에 관한 법률에 의하여 통신판매중개자의 지위를 가지고 회원간 거래행위에 있어 발생되는 사기행위 등 문제에 있어 일체의 책임을 지지 않으며, 이는 거래 회원 당사자간 직접 해결하여야 합니다.

제 15 조 (개별약관)

① 이 약관은 회사와 회원간에 성립되는 서비스이용계약의 기본약정입니다. 회사는 필요한 경우 특정 서비스에 관하여 적용될 사항(이하 "개별약관"이라고 합니다)을 정하여 미리 공지할 수 있습니다. 회원이 이러한 개별약관에 동의하고 특정 서비스를 이용하는 경우에는 개별약관이 우선적으로 적용되고, 이 약관은 보충적인 효력을 갖습니다.
② 회사는 필요한 경우 서비스 이용과 관련된 세부적인 개별내용(이용정책 등)을 정하여 회사의 사이트 등을 통하여 공지할 수 있습니다.

제 16 조 (아이템거래 관련 서비스 수수료의 내용)

회사는 판매자에게 인터넷을 통한 서비스를 제공하는 대가로 다음과 같은 수수료를 거래 종료 시점에서 부과합니다.
① 구매시의 수수료는 없습니다.
② 판매시의 수수료는 다음과 같이 건당 부과 합니다.
1. 거래금액의 5%
 2. 기본 수수료 1,000원 부과
3. 최대 수수료 금액은 47,000원을 넘지 않습니다.
③ 수수료는 거래가 정상적으로 종료되었을 때 판매자에게 부과됩니다.
④ 부가 수수료 : 회사에서 제공하는 부가서비스에 대한 대가로 부과됩니다.

제 17 조 (아이템거래 관련 서비스 수수료 부과 방법)

거래를 통해 거래가 정상 종료되어 판매자에게 물품대금을 적립할 경우 제16조에서 규정한 해당 거래의 수수료를 제외하고 적립합니다.

제 18 조 (아이템거래 관련 서비스 수수료 부과의 예외)

① 회사가 수수료를 부과하지 않기로 결정한 거래에 대해서는 수수료를 부과하지 않습니다.
② 구매자가 '물품인수확인' 버튼을 클릭하여, 물품대금이 판매자에게 송금된 후에 반품이나 환불이 될 경우에도 해당거래로 징수된 수수료는 환불되지 않습니다.

[부칙]
1. 이 약관은 2020년 5월 1일부터 적용됩니다.
2. 2018년 10월 15일부터 시행되던 종전의 약관은 본 약관으로 대체됩니다.</div>
</pre>
            </div>
            ※ 약관 중 이벤트 등 광고 알림 수신 동의 내용이 포함되어 있습니다.

            <div class="agree_check_s">
                <input type="checkbox" id="user_agreement2" name="user_agreement2" value="1">
                <label for="user_agreement2">개인정보 수집 및 이용에 동의합니다.
                    <span class="f_blue3">(필수)</span></label>
            </div>
            <div class="clause_box">
<pre> 개인정보 수집이용 등에 대한 이용자 동의사항

1. 수집하는 개인정보의 항목 및 수집방법

[필수 수집항목]
회원가입 시점에 ㈜아이템천사가 이용자로부터 필수로 수집하는 개인정보는 아래와 같습니다.
- 성명, 아이디(계정), 생년월일, 외국인등록번호(외국인에 한함), 주소, 비밀번호, 비밀번호 확인, 이메일주소, 연락처(자택/직장), 연락처(휴대폰), 인증값, 아이핀(i-Pin)번호, 국가, 성별, 연계정보(CI/DI), IP Address, 인증값

[선택 수집항목]
㈜아이템천사 서비스 이용 중에 이용자로부터 선택적으로 수집하는 개인정보는 아래와 같습니다.
- 은행계좌정보(예금주/은행명/계좌번호), 휴대폰결제(생년월일/이동통신사/결제인증번호), 상품권정보(상품권 계정, 쿠폰번호, 패스워드), 개인정보 자동수집 장치를 통한 쿠키정보, 네이버아이디, 즐겨하는 게임 및 기타 선택항목, 수취인정보, 회원번호, 태어난 시간, 음력/양력

[개인정보 수집방법]
- 회원가입 시 온라인상에서의 입력 및 기타 이용자의 자발적인 제공 등

2. 개인정보의 수집 및 이용 목적
- 회원제 서비스 이용에 따른 본인 확인 절차, 연령 제한 서비스 및 개인 맞춤서비스의 제공 및 기업회원제 서비스 이용에 따른 확인 절차, 불량회원의 부정 이용 방지와 비인가 사용 방지
- 고지사항 전달, 본인 의사 확인, 불만처리 등을 위한 원활한 의사소통 경로의 확보
- 서비스 및 부가 서비스 이용에 대한 요금 결제 및 청구서, 물품배송시 정확한 배송지의 확보
- 인구통계학적 분석 자료(연령별, 성별, 지역별 통계 분석)
- 로또추천번호 서비스 제공


3. 개인정보의 보유 및 이용기간
- 회원님의 개인정보는 개인정보의 수집목적 또는 제공 받은 목적이 달성되면 파기됩니다. 단, 전자상거래 등에서의 소비자보호에 관한 법률 및 상법 등 관련 법령의 규정에 의하여 보존할 필요성이 있는 경우에는 법령에서 규정한 보존기간 동안 거래내역 및 개인정보는 일정기간 보유하며 그 보유기간이 경과하지 아니한 경우와 개별적으로 이용자의 동의를 받을 경우에는 약속한 보유기간 동안 개인정보를 보유합니다.
- 회사는 동일한 계정으로 중복 가입하는 경우를 방지하기 위하여 회원 탈퇴 후에도 해당 아이디는 삭제하지 아니합니다.
- 로또추천번호 : 적중내역 확인일로부터 1년 보관
				</pre>
            </div>

            <div class="agree_check_s">
                <input type="checkbox" id="user_agreement10" name="user_agreement10" value="10">
                <label for="user_agreement10">광고 정보 수신동의
                    <span class="black">(선택)</span></label>
            </div>
            <div class="clause_box clause_box2">
<pre>고객이 수집 및 이용에 동의한 개인정보를 활용하여 전자적 전송매체(SMS, LMS, 네이버 알림, 앱 푸시 등 다양한 전송매체)를 통해,
아이템천사 및 제 3자의 상품 또는 서비스에 대한 개인 맞춤형 광고 정보를 전송할수 있습니다.
</pre>
            </div>

            <div class="agree_check_s">
                <input type="checkbox" id="user_agreement3" name="user_agreement3" value="1">
                <label for="user_agreement3">개인정보 제 3자 마케팅 활용에 동의합니다.
                    <span class="black">(선택)</span></label>

            </div>
            <div class="clause_box">
<pre>목적
(주)아이템천사는 고객들에게 보다 다양한 정보를 제공하고, 서비스의 질을 향상시키기 위하여 당사의 비즈니스 파트너에게 본 활용동의서에 동의한 회원의 개인정보를 제공합니다.

1. 수집 및 활용 관련 정보
개인정보가 제공되는 비즈니스 파트너 사와 제공 정보, 제공된 정보의 이용목적은 아래와 같습니다. 회원님들 중 이 개인정보의 제3자 마케팅 활용동의서에 동의하신 회원님들의 정보만이 제공되며, 제공된 정보는 명시된 이용목적을 벗어나 이용되지 않고, 개인정보의 유출 등 사고가 일어나지 않도록 더욱 철저한 보안이 이루어지도록 노력하고 있습니다.

<table class="table-primary tb_list">
<colgroup>
<col width="200">
<col width="250">
<col width="150">
<col>
</colgroup>
<tbody><tr>
<th>제공받는자</th>
<th>제공목적</th>
<th>제공항목</th>
<th>제공기간</th>
</tr>
<tr>
<td>
㈜핀크럭스
㈜아이지에이웍스
㈜아이브코리아
</td>
<td>무료충전소서비스 내 마일리지적립 및 문의사항 처리에 이용</td>
<td>회원 아이디(회원번호)</td>
<td>회원탈퇴 시 혹은 위탁계약 종료 시 까지, 법령이 정한 시점</td>
</tr>
<tr>
<td>
㈜핀크럭스
</td>
<td>
[무료충전소 서비스]
무료충전소서비스 내 마일리지적립및문의사항 처리에 이용

[보험개발원 정보망관련]
보험개발원 정보망을 통한 보험계약 및 사고관련정보 조회, 보험상품 등의 안내를 위한 이메일,전화,SMS서비스 제공 등 마케팅자료 제공
</td>
<td>회원 아이디(회원정보), 성명, 주소, 전화번호, 생년월일, 성별, 이메일, 휴대폰번호, 가입일자</td>
<td>
[무료충전소 서비스 기간]
회원탈퇴 시 혹은 계약 종료 시 까지, 법령이 정한 시점

[보험개발원 정보망관련 기간]
개인정보 제공 동의 일로부터 5년
</td>
</tr>
<tr>
<td>
제이엠미디어㈜
㈜오렌지마케팅
지에이코리아 주식회사
리더스 금융판매㈜
더케이손해보험
라이나생명
롯데손해보험
에이스손해보험
한화손해보험
</td>
<td>보험개발원 정보망을 통한 보험계약 및 사고관련정보 조회, 보험상품 등의 안내를 위한 이메일,전화,SMS서비스 제공 등 마케팅자료 제공</td>
<td>성명, 주소, 전화번호, 생년월일,성별, 이메일, 휴대폰번호, 가입일자</td>
<td>개인정보 제공 동의 일로부터 5년</td>
</tr>
<tr>
<td>
(주)갤럭시아머니트리
(주)스마트콘
(주)BGF네트웍스
</td>
<td>상품배송</td>
<td>휴대폰번호</td>
<td>서비스 제공완료 3개월 후 삭제</td>
</tr>
<tr>
<td>
(주)티디미디어
(주)디엠셀파
</td>
<td>상품배송</td>
<td>성명,주소,휴대폰번호</td>
<td>서비스 제공완료 3개월 후 삭제</td>
</tr>
<tr>
<td>(주)챔프스터디</td>
<td>상품배송</td>
<td>회원아이디,성명,주소,휴대폰번호</td>
<td>서비스 제공완료 3개월 후 삭제</td>
</tr>
<tr>
<td>비즈톡㈜</td>
<td>네이버 스마트 알림톡 발송</td>
<td>휴대폰번호</td>
<td>회원탈퇴 시 혹은 계약 종료 시 까지, 법령이 정한 시점</td>
</tr>
<tr>
<td>KTH</td>
<td rowspan="2">안심번호 발급</td>
<td rowspan="2">휴대폰번호</td>
<td rowspan="2">회원 탈퇴 시 혹은 위탁계약 종료 시 까지, 법령이 정한 시점</td>
</tr>
<tr>
<td>(주)싱크에이티</td>
</tr>
<tr>
<td>(주)팝아이콘</td>
<td>로또팟 서비스 제공</td>
<td>회원아이디(회원번호)</td>
<td>회원탈퇴 시 혹은 제3자 정보 제공동의 철회 시 또는 제휴 계약 종료 시 까지</td>
</tr>
</tbody></table>

2. 개인정보 활용 및 처리방침
본 동의서에 동의하고 가입하신 신규회원 중 제3자 정보제공을 철회하고 싶은 회원은 이미 제3자에게 제공된 개인정보라 하더라도, 언제든지 열람, 정정, 삭제를 요구할 수 있습니다.
열람, 정정, 삭제 및 정보제공 동의 철회는 전화와 팩스 등을 통하여 본인 확인 후 요청할 수 있습니다. 또한 향후의 정보제공을 원치 않거나, 새롭게 동의를 하고자 하는 경우에는 회원정보 수정을 통하여 마케팅 동의 여부를 변경할 수 있습니다.
이미 제공된 회원정보를 철회하는 데는 일정 시간이 소요됩니다. 활용동의 철회를 요청하시더라도 위와 같은 이유로 마케팅에 활용될 수 있음을 알려드립니다.
(주)아이템천사는 회원님의 소중한 정보를 보호하기 신속하게 처리되도록 최선에 노력을 다하겠습니다.
</pre>
            </div>


            <div class="agree_check_s">
                <input type="checkbox" name="user_service_use_agree" id="user_service_use_agree" value="1">
                <label for="user_service_use_agree">
                    개인정보를 파기 또는 분리 저장 ∙ 관리하여야 하는 서비스 미 이용 기간을 회원 탈퇴 시 까지로 요청합니다.
                    <span class="black">(선택)</span><br>
                    <span class="normal">※ 다만, 별도의 요청이 없을 경우 서비스 미이용 기간은 1년으로 합니다.</span>
                </label>
            </div>


            <div class="d-flex user-verify-part" >
                <div class="w-50 align-center" style="border-right: solid 1px #d5d5d5;">
                    <img id="verify-phone" src="/angel/img/reg/phone_icon.png" width="153" height="153" onclick="verifyPhone()" />
                    <div class="verify-type f-16 f-bold align-center" style="color: #0E8BFF">휴대폰</div>
                    <div class="verify-detail f-15 align-center">본인 명의의 휴대폰으로 인증번호를 받은 후<br>가입하실수 있습니다.</div>
                </div>
                <div class="w-50 align-center">
                    <img id="verify-pin" src="/angel/img/reg/pin_icon.png" width="153" height="153" onclick="verifyPin()" />
                    <div class="verify-type f-16 f-bold align-center" style="color: #0E8BFF">아이핀 (I-PIN)</div>
                    <div class="verify-detail f-15 align-center">인터넷상 개인 식별번호로 본인임을<br>확인할 수 있는 개인정보보호 서비스</div>
                </div>
            </div>
            <form id="form-next-step" method="post" action="{{route('user_reg_step3')}}">
                @csrf
                <input type="hidden" name="userName" value="" id="userName" />
                <input type="hidden" name="userBirth" value="" id="userBirth" />
                <input type="hidden" name="userType" value="{{$userType}}" />
                <input type="hidden" name="phoneType" id="phoneType" value="" />
                <input type="hidden" name="phoneNum1" id="phoneNum1" value="" />
                <input type="hidden" name="phoneNum2" id="phoneNum2" value="" />
                <input type="hidden" name="phoneNum3" id="phoneNum3" value="" />
            </form>
            <div class="empty-high"></div>
        </div>
    </div>
    <script>
        function verifyPhone() {
            if (document.getElementById("agreement_all").checked) {
                document.getElementById("userName").setAttribute('value', "홍길동");
                document.getElementById("userBirth").setAttribute('value', "1991-05-15");
                document.getElementById("phoneType").setAttribute('value', "1");
                document.getElementById("phoneNum1").setAttribute('value', "011");
                document.getElementById("phoneNum2").setAttribute('value', "1234");
                document.getElementById("phoneNum3").setAttribute('value', "5678");

                document.getElementById("form-next-step").submit();
            }
        }
        function verifyPin() {
            if (document.getElementById("agreement_all").checked) {
                document.getElementById("userName").setAttribute('value', "상상");
                document.getElementById("userBirth").setAttribute('value', "1980-11-28");
                document.getElementById("phoneType").setAttribute('value', "2");
                document.getElementById("phoneNum1").setAttribute('value', "011");
                document.getElementById("phoneNum2").setAttribute('value', "1234");
                document.getElementById("phoneNum3").setAttribute('value', "5678");

                document.getElementById("form-next-step").submit();
            }
        }
    </script>
@endsection
