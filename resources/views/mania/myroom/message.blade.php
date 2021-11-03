@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/message/css/index.css?190220">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21100816"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/myroom/message/js/index.js?190220"></script>
@endsection

@section('content')
<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    <div class="aside">
        <div class="nav_subject"><a href="http://trade.itemmania.com/myroom/" class="myroom">MyRoom</a></div>
        <div class="nav">
            <div class="nav_title on_active"><a href="http://trade.itemmania.com/myroom/message/">메세지함</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/sell/sell_regist.html">판매관련</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/buy/buy_regist.html">구매관련</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/goods_alarm/alarm_sell_list.html">물품등록 알리미<span class="new">N</span></a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/complete/sell.html">종료내역</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/complete/cancel_sell.html">취소내역</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/mileage/my_mileage/">마일리지</a></div>
            <ul class='nav_sub g_list'>
                <li class=""><a href="http://trade.itemmania.com/myroom/mileage/my_mileage/">내마일리지</a></li>
                <li class=""><a href="http://trade.itemmania.com/myroom/mileage/guide/charge.html">마일리지충전</a></li>
                <li class=""><a href="http://trade.itemmania.com/myroom/mileage/payment/payment_switch.html">마일리지출금</a></li>
                <li class=""><a href="http://trade.itemmania.com/myroom/mileage/change/culturecash/">마일리지전환</a></li>
            </ul>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/myinfo/myinfo_check.html">개인정보</a></div>
            <ul class='nav_sub g_list'>
                <li class=""><a href="http://trade.itemmania.com/myroom/myinfo/myinfo_check.html">개인정보수정</a></li>
                <li class=""><a href="http://trade.itemmania.com/myroom/myinfo/myinfo_login_sync.html">로그인연동관리</a></li>
                <li class=""><a href="http://trade.itemmania.com/myroom/myinfo/myinfo_offer_check.html">수신/동의철회</a></li>
                <li class=""><a href="http://trade.itemmania.com/myroom/myinfo/credit_rating.html">신용등급/인증</a></li>
            </ul>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/lotto/lottopot.html">로또 추천번호</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/pmall/spointmall.html">쇼핑포인트</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/cash_receipt/cash_receipt_list.html">현금영수증</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/coupon/free.html">이용권현황</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/myinfo/myinfo_safe_settlement.html">보안센터</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/customer/">환경설정</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/user_leave/user_leave_form.html">회원탈퇴</a></div>
        </div>
    </div>
    <div class="g_content">
        <!-- ▼ 타이틀 //-->
        <div class="g_title_blue"> 메세지함
            <ul class="g_path">
                <li>홈</li>
                <li>마이룸</li>
                <li class="select">메세지함</li>
            </ul>
        </div>
        <!-- ▲ 타이틀 //-->
        <!-- ▼ 메뉴탭 //-->
        <ul class="g_tab">
            <li class='first selected'><a href="/myroom/message/">신규메시지</a></li>
            <li><a href="/myroom/message/?type=trade">거래메시지</a></li>
            <li><a href="/myroom/message/?type=admin">관리자메시지</a></li>
            <li><a href="/myroom/message/myqna_list.html">나의 질문과 답변</a></li>
            <li class='last'><a href="/myroom/message/?type=storage">메시지보관함</a></li>
        </ul>
        <!-- ▲ 메뉴탭 //-->
        <!-- ▼ 테이블 상단 //-->
        <ul class="tab_sib">
            <li class="g_left">
                <div id="split_btn"> <img id="split_btn_all" src="http://img3.itemmania.com/images/btn/btn_all_box.gif" width="42" height="20"> <img id="split_btn_options" src="http://img4.itemmania.com/images/btn/btn_down0.gif" width="15" height="20">
                    <ul id="split_btn_layer" class="g_hidden g_selectbox_list">
                        <li><a href="#" onclick="splitButton.onSelAll();">전체선택</a></li>
                        <li><a href="#" onclick="splitButton.onSelCancel();">선택해제</a></li>
                    </ul>
                </div> <img src="http://img2.itemmania.com/images/btn/btn_del1.gif" onclick="$('#procType').val('delete');$('#frmDeleteAll').submit();" class="g_button" width="42" height="20" alt="삭제"> <img src="http://img3.itemmania.com/images/icon/ico_message_on.gif" width="14" height="11" class="g_icon"> <a href='./?type=trade&state=1'>거래 메시지 <span class="f_blue3 f_bold">35개</span></a> |
                <!--                    -->
                <!--마켓 메시지 <span class="f_blue3 f_bold">-->
                <!--개</span>-->
                <!-- |--><a href='./?type=admin&state=1'>관리자 메시지 <span class="f_blue3 f_bold">34개</span></a> </li>
        </ul>
        <!-- ▲ 테이블 상단 //-->
        <!-- ▼ 메시지 확인 //-->
        <form id="frmDeleteAll" name="frmDeleteAll" action="" method="post">
            <input type="hidden" id="procType" name="procType" value="">
            <table class="g_blue_table tb_list">
                <colgroup>
                    <col width="48">
                    <col width="47">
                    <col width="69">
                    <col />
                    <col width="145">
                </colgroup>
                <tr>
                    <th>선택</th>
                    <th>상태</th>
                    <th>종류</th>
                    <th>내용</th>
                    <th>도착일시</th>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="160817155" class="g_checkbox">
                        <input type="hidden" name="message_date[]" value="2021-10-12 15:19:33">
                        <input type="hidden" name="message_state[]" value="1"> </td>
                    <td><img src="http://img4.itemmania.com/images/icon/ico_message_on.gif" alt="읽지않음"></td>
                    <td>거래</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">고객님께서 판매 등록하신 #2021101207986089 물품이 숨김 상태가 되었습니다.</td>
                    <td>2021-10-12 15:19</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="160690433" class="g_checkbox">
                        <input type="hidden" name="message_date[]" value="2021-10-09 02:57:26">
                        <input type="hidden" name="message_state[]" value="1"> </td>
                    <td><img src="http://img4.itemmania.com/images/icon/ico_message_on.gif" alt="읽지않음"></td>
                    <td>거래</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">고객님께서 판매중이신 #2021100901324270 물품이 취소되었습니다.</td>
                    <td>2021-10-09 02:57</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="160638320" class="g_checkbox">
                        <input type="hidden" name="message_date[]" value="2021-10-07 18:22:10">
                        <input type="hidden" name="message_state[]" value="1"> </td>
                    <td><img src="http://img4.itemmania.com/images/icon/ico_message_on.gif" alt="읽지않음"></td>
                    <td>거래</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">고객님께서 판매중이신 #2021100710985114 물품이 취소되었습니다.</td>
                    <td>2021-10-07 18:22</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="160638135" class="g_checkbox">
                        <input type="hidden" name="message_date[]" value="2021-10-07 18:17:10">
                        <input type="hidden" name="message_state[]" value="1"> </td>
                    <td><img src="http://img4.itemmania.com/images/icon/ico_message_on.gif" alt="읽지않음"></td>
                    <td>거래</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">고객님께서 판매중이신 #2021100711068190 물품이 취소되었습니다.</td>
                    <td>2021-10-07 18:17</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="160523843" class="g_checkbox">
                        <input type="hidden" name="message_date[]" value="2021-10-03 23:20:13">
                        <input type="hidden" name="message_state[]" value="1"> </td>
                    <td><img src="http://img4.itemmania.com/images/icon/ico_message_on.gif" alt="읽지않음"></td>
                    <td>거래</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">고객님께서 판매 등록하신 #2021100314579812 물품이 숨김 상태가 되었습니다.</td>
                    <td>2021-10-03 23:20</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="160521762" class="g_checkbox">
                        <input type="hidden" name="message_date[]" value="2021-10-03 21:55:58">
                        <input type="hidden" name="message_state[]" value="1"> </td>
                    <td><img src="http://img4.itemmania.com/images/icon/ico_message_on.gif" alt="읽지않음"></td>
                    <td>거래</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">고객님께서 판매 등록하신 #2021100314178695 물품이 숨김 상태가 되었습니다.</td>
                    <td>2021-10-03 21:55</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="160509800" class="g_checkbox">
                        <input type="hidden" name="message_date[]" value="2021-10-03 14:18:22">
                        <input type="hidden" name="message_state[]" value="1"> </td>
                    <td><img src="http://img4.itemmania.com/images/icon/ico_message_on.gif" alt="읽지않음"></td>
                    <td>거래</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">고객님께서 판매중이신 #2021100309098254 물품이 취소되었습니다.</td>
                    <td>2021-10-03 14:18</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="160509385" class="g_checkbox">
                        <input type="hidden" name="message_date[]" value="2021-10-03 14:00:45">
                        <input type="hidden" name="message_state[]" value="1"> </td>
                    <td><img src="http://img4.itemmania.com/images/icon/ico_message_on.gif" alt="읽지않음"></td>
                    <td>거래</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">고객님께서 판매중이신 #2021100308843914 물품이 취소되었습니다.</td>
                    <td>2021-10-03 14:00</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="160468658" class="g_checkbox">
                        <input type="hidden" name="message_date[]" value="2021-10-02 01:54:22">
                        <input type="hidden" name="message_state[]" value="1"> </td>
                    <td><img src="http://img4.itemmania.com/images/icon/ico_message_on.gif" alt="읽지않음"></td>
                    <td>거래</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">고객님께서 판매중이신 #2021100201185697 물품이 취소되었습니다.</td>
                    <td>2021-10-02 01:54</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="159191781" class="g_hidden">
                        <input type="hidden" name="message_date[]" value="2021-07-08 04:46:02">
                        <input type="hidden" name="message_state[]" value="1"> <span class="bold_txt">X</span> </td>
                    <td><img src="http://img4.itemmania.com/images/icon/ico_message_on.gif" alt="읽지않음"></td>
                    <td>관리자</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">고객님께서 판매 신청하신 #2021070802489650물품이 취소되었습니다.</td>
                    <td>2021-07-08 04:46</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="157357746" class="g_hidden">
                        <input type="hidden" name="message_date[]" value="2021-02-15 19:59:25">
                        <input type="hidden" name="message_state[]" value="1"> <span class="bold_txt">X</span> </td>
                    <td><img src="http://img4.itemmania.com/images/icon/ico_message_on.gif" alt="읽지않음"></td>
                    <td>관리자</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">고객님께서 판매중이신 # 물품이 취소접수가 되었습니다.</td>
                    <td>2021-02-15 19:59</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="157357394" class="g_hidden">
                        <input type="hidden" name="message_date[]" value="2021-02-15 19:42:34">
                        <input type="hidden" name="message_state[]" value="1"> <span class="bold_txt">X</span> </td>
                    <td><img src="http://img4.itemmania.com/images/icon/ico_message_on.gif" alt="읽지않음"></td>
                    <td>관리자</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">고객님께서 판매중이신 # 물품이 취소접수가 되었습니다.</td>
                    <td>2021-02-15 19:42</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="157357373" class="g_hidden">
                        <input type="hidden" name="message_date[]" value="2021-02-15 19:41:48">
                        <input type="hidden" name="message_state[]" value="1"> <span class="bold_txt">X</span> </td>
                    <td><img src="http://img4.itemmania.com/images/icon/ico_message_on.gif" alt="읽지않음"></td>
                    <td>관리자</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">고객님께서 판매중이신 # 물품이 취소접수가 되었습니다.</td>
                    <td>2021-02-15 19:41</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="157281084" class="g_hidden">
                        <input type="hidden" name="message_date[]" value="2021-02-10 21:40:13">
                        <input type="hidden" name="message_state[]" value="1"> <span class="bold_txt">X</span> </td>
                    <td><img src="http://img4.itemmania.com/images/icon/ico_message_on.gif" alt="읽지않음"></td>
                    <td>관리자</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">고객님께서 판매중이신 # 물품이 취소접수가 되었습니다.</td>
                    <td>2021-02-10 21:40</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="157280889" class="g_hidden">
                        <input type="hidden" name="message_date[]" value="2021-02-10 21:30:31">
                        <input type="hidden" name="message_state[]" value="1"> <span class="bold_txt">X</span> </td>
                    <td><img src="http://img4.itemmania.com/images/icon/ico_message_on.gif" alt="읽지않음"></td>
                    <td>관리자</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">고객님께서 판매중이신 # 물품이 취소접수가 되었습니다.</td>
                    <td>2021-02-10 21:30</td>
                </tr>
            </table>
        </form>
        <!-- ▲ 메시지 확인 //-->
        <div class="tb_bt_txt"> <img src="http://img2.itemmania.com/images/btn/btn_msg_save.gif" width="85" height="20" onclick="$('#procType').val('save');$('#frmDeleteAll').submit();" class="g_button" alt="보관함에 저장"> <span class="f_org1">- 메시지는 올해를 제외한 이전 6개월만 보관되오니, 중요한 메시지는 보관함에 저장하시기 바랍니다.</span> </div>
        <div class="g_finish"></div>
        <!-- ▼ 페이징 //-->
        <div class="dvPaging">
            <ul class="g_paging">
                <li class='start'><strong class="g_blue">1</strong></li>
                <li><a href="?page=2&type=new&state=1&dateFlag=">2</a></li>
                <li><a href="?page=3&type=new&state=1&dateFlag=">3</a></li>
                <li><a href="?page=4&type=new&state=1&dateFlag=">4</a></li>
                <li class='end'><a href="?page=5&type=new&state=1&dateFlag=">5</a></li>
                <li class='last'>
                    <a href="?page=5&type=new&state=1&dateFlag="><img src='http://img1.itemmania.com/images/btn/btn_end2.gif'></a>
                </li>
            </ul>
        </div>
        <!-- ▲ 페이징 //-->
    </div>
    <!-- ▼ 메시지 레이어 //-->
    <div id="message_view" class="g_popup">
        <div class="layer_title"> 메시지
            <div class="btn_close" onclick="g_nodeSleep.disable();"></div>
        </div>
        <div class="layer_content">
            <table class="g_blue_table">
                <colgroup>
                    <col width="120">
                    <col width="187">
                    <col width="120">
                    <col width="187">
                </colgroup>
                <tr>
                    <th>종류</th>
                    <td><span id="dvMessage_type"></span></td>
                    <th>날짜</th>
                    <td><span id="dvMessage_date"></span></td>
                </tr>
                <tr id="tr_none">
                    <th>거래번호</th>
                    <td><span id="dvMessage_id"></span></td>
                    <th class="continue">거래금액</th>
                    <td><span id="dvMessage_price"></span></td>
                </tr>
                <tr>
                    <th>제목</th>
                    <td colspan="3"><span id="dvMessage_title"></span></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="dvMessage_content"></div>
                    </td>
                </tr>
            </table>
            <div class="g_left">
                <a href="../../customer/"><img src="http://img4.itemmania.com/images/btn/btn_1vs1_blue.gif" width="104" height="34" alt="1:1 문의하기"></a>
            </div>
            <div class="g_left" id="dvMessage_move"><span class="bold_txt"><a href="#">이전</a> | <a href="#">다음</a></span></div>
            <div class="g_right">
                <a href="#" onclick="$.fnDelete();"><img src="http://img2.itemmania.com/images/btn/btn_del2.gif" width="66" height="34" alt="삭제"></a>
            </div>
        </div>
    </div>
    <!-- ▲ 메시지 레이어 //-->
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
