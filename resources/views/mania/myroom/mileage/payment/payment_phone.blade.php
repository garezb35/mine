@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type='text/css' rel='stylesheet' href='/mania/myroom/mileage/payment/css/payment_phone.css?v=190220'>
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type='text/javascript' src='/mania/myroom/mileage/payment/js/payment_phone.js?v=190220'></script>
    <script type='text/javascript' src='/mania/myroom/mileage/payment/js/mile_gift.js?v=210323'></script>
    <script type='text/javascript'>
        var gsVersion = '2110141801';
        var _LOGINCHECK = '1';
    </script>
@endsection

@section('content')
<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    @include('mania.myroom.aside', ['group'=>'mileage', 'part'=>'payment'])
    <div class="g_content">
        <!-- ▼ 타이틀 //-->
        <div class="g_title_blue"> 마일리지 출금
            <ul class="g_path">
                <li>홈</li>
                <li>마이룸</li>
                <li>마일리지</li>
                <li class="select">마일리지 출금</li>
            </ul>
        </div>
        <!-- ▲ 타이틀 //-->
        <!-- ▼ 메뉴탭 //-->
        <div class="g_tab">
            <div class=""><a href="https://trade.itemmania.com/myroom/mileage/payment/index.html">은행계좌 출금</a></div>
            <div class="selected icon_new"> <a href="http://trade.itemmania.com/myroom/mileage/payment/payment_phone.html">휴대폰번호 출금<span class="ballon_24hours"></span></a> </div>
            <div class=""><a href="http://trade.itemmania.com/myroom/mileage/payment/payment_list.html">마일리지 출금내역 보기</a></div>
            <div class=" icon_new"><a href="http://trade.itemmania.com/myroom/mileage/payment/payment_phone_list.html">휴대폰번호 출금내역 보기</a></div>
        </div>
        <!-- ▲ 메뉴탭 //-->
        <form id="payment" name="payment" method="post" action="payment_phone_ok.php">
            <input type="hidden" name="total_mileage" id="total_mileage" value="3245">
            <input type="hidden" name="enable_mileage" id="enable_mileage" value="245">
            <input type="hidden" name="charge" id="charge" value="">
            <input type="hidden" name="creditrating" id="creditrating" value="">
            <input type="hidden" name="dailycount" id="dailycount" value="">
            <input type="hidden" name="user_mobileA" value="010">
            <input type="hidden" name="user_mobileB" value="4797">
            <input type="hidden" name="user_mobileC" value="3690">
            <input type="hidden" name="seq" value="0">
            <div class="g_subtitle first">나의 휴대폰번호 출금</div>
            <table class="g_blue_table">
                <colgroup>
                    <col width="160">
                    <col>
                </colgroup>
                <tr>
                    <th>출금휴대폰번호</th>
                    <td class="g_black3_11"> 010-4797-3690 <img src="https://img2.itemmania.com/images/btn/btn_regist2.gif" width="60" height="20" alt="등록하기" id="btn_reg" class="g_button">
                        <div class="g_right">
                            <a href="#" onclick="_window.open('private_edit', '/user/contact_edit.html?check=true', 496, 350);"> <img src="https://img3.itemmania.com/images/btn/btn_hp_edit.gif" width="85" height="18" alt="연락처 수정"> </a>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="g_subtitle">출금신청</div>
            <table class="g_blue_table">
                <colgroup>
                    <col width="160">
                    <col>
                </colgroup>
                <tr>
                    <th>총 마일리지</th>
                    <td class="f_bold">
                        <div class="total_mile">3,245 원</div>
                    </td>
                </tr>
                <tr>
                    <th>출금가능 마일리지</th>
                    <td><span id="mileage_total">245</span> 원
                        <div class="g_right">
                            <a href="/myroom/mileage/my_mileage/"><img src="https://img4.itemmania.com/images/btn/btn_mileage_detail.gif" width="116" height="18" alt="마일리지 자세히보기"></a>
                        </div>
                        <!--                        <div class="g_black3_11">총 마일리지 중 사용 전용 마일리지 및 거래중 마일리지는 출금이<br>불가합니다.</div>-->
                    </td>
                </tr>
                <tr>
                    <th>출금할 마일리지</th>
                    <td>
                        <ul>
                            <li class="f_bold">
                                <input type="text" name="mileage" id="mileage" class="g_text" maxlength="11"> 원 </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th colspan="2">실제 출금마일리지 : <span class="spnPayment_mileage" id="spnPayment_mileage">0</span>원 </th>
                </tr>
            </table>
            <div class="app_bg">
                <div class="tcash_info"> <span class="font_yellow">[TCash 안내]</span>
                    <br> 신속하고, 빠르게 출금하는 모바일 티캐시
                    <br> 휴대폰에 계좌등록만으로
                    <br> 24시간 실시간 출금가능!! </div>
                <ul class="tcash_tab">
                    <li class="selected">T 마일리지</li>
                    <li class="">아이템마일리지</li>
                </ul>
                <div class="mileage_money"> <span id="mileage_money">0</span>원 </div>
                <ul class="top_link">
                    <li>
                        <a href="https://play.google.com/store/apps/details?id=com.tcash.tcash" target="_blank" title="Google Play"></a>
                    </li>
                    <li>
                        <a href="https://itunes.apple.com/kr/app/tcash/id1134866098?mt=8" target="_blank" title="App Store"></a>
                    </li>
                </ul>
            </div>
        </form>
        <div class="g_finish"></div>
        <div class="tb_bt_txt f_bold"> [TCash 적립 안내]
            <br> ㆍ<span class="f_red1">T마일리지</span> : 사용, 출금, 보내기 가능 / <span class="f_red1">아이템마일리지</span> : 사용, 전환 출금, 보내기 가능
            <br> ㆍ아이템매니아 출금 계좌 인증 시 T마일리지로 적립
            <br> * Tcash 앱을 통하여 출금 시 별도의 수수료가 부과될 수 있습니다. </div>
        <div class="g_btn">
            <input type="image" src="https://img3.itemmania.com/images/btn/btn_phone_with.gif" width="115" height="37" alt="휴대폰번호 출금" class="g_image" id="btn_payment"> </div>
        <style type="text/css">
            .btn_buy_mileage {
                width: 110px;
                height: 32px;
                color: white;
                background: #1076D1;
                margin: 0 auto;
                text-align: center;
                line-height: 32px;
            }

            .mile_giftcard {
                width: 100%;
                height: auto;
                padding: 15px 21px;
                background: #f4f4f4;
                border: 1px solid #dddddd;
                box-sizing: border-box;
                overflow: hidden;
            }

            .mile_giftcard .g_right {
                margin: 12px 2px 0 0
            }

            .mile_giftcard .g_right > .btn_blue3 {
                width: 110px;
                height: 20px;
                line-height: 18px;
                font-size: 12px;
            }

            .giftcard_list .gift_buy {
                float: left;
                margin: 10px 0 0 5px;
                width: 188px;
                border: 1px solid #CCD3DC;
                background-color: #FFF
            }

            .giftcard_list .gift_buy:first-child {
                margin-left: 0;
            }

            .giftcard_list .gift_buy li {
                width: 188px;
                text-align: center;
            }

            .giftcard_list .gift_buy .product_name {
                margin-bottom: 10px;
            }

            .giftcard_list .gift_buy li .icon {
                position: absolute;
                top: -12px;
                left: 0
            }

            .giftcard_list .gift_buy .btn {
                margin: 15px 0 14px;
            }

            .giftcard_list .gift_buy .btn div {
                cursor: pointer
            }

            .sp_mr {
                display: inline-block;
                background: url(//img2.itemmania.com/new_images/myroom/myroom_sp.png) no-repeat;
                text-indent: -9999px;
            }

            .sp_mr.culture {
                width: 141px;
                height: 88px;
                margin-top: 32px;
                background-position: -2px -884px;
            }

            .sp_mr.oncash {
                width: 134px;
                height: 95px;
                margin-top: 26px;
                background-position: -153px -884px;
            }

            .sp_mr.happy {
                width: 135px;
                height: 86px;
                margin-top: 35px;
                background-position: -297px -884px;
            }

            .sp_mr.google {
                width: 120px;
                height: 102px;
                margin-top: 20px;
                background-position: -442px -884px;
            }
            /*.mile_giftcard .gift_buy li {padding:0;}*/
            /*.mile_giftcard .gift_buy .btn {padding-top:10px;}*/
            /*.mile_giftcard .gift_buy .product_name {padding:0;}*/
        </style>
        <div class="g_smtitle">마일리지 활용하기</div>
        <div class="g_big_box1 mile_giftcard">
            <div class="g_left"> 아이템매니아 마일리지를 통해 다양한 상품권 또는 선불카드 구매가 가능합니다.
                <br> (단, 자동이체 및 이벤트를 통해 적립된 마일리지는 사용이 불가능합니다.) </div>
            <div class="g_right"> <a class="btn_blue3" href="http://giftcard.itemmania.com/portal/giftcard/">상품권몰 바로가기</a> </div>
            <div class="g_finish"></div>
            <div class="giftcard_list">
                <ul class="gift_buy g_sideway">
                    <li class="product_img"> <span class="sp_mr culture">문화상품권</span> </li>
                    <li class="product_name f_black2 f_bold"> 문화상품권 </li>
                    <li class="select_gift">
                        <select name="kspay" id="kspay">
                            <option value="1000">1,000원 권</option>
                            <option value="3000">3,000원 권</option>
                            <option value="5000">5,000원 권</option>
                            <option value="10000">10,000원 권</option>
                            <option value="20000">20,000원 권</option>
                            <option value="30000">30,000원 권</option>
                            <option value="50000">50,000원 권</option>
                            <option value="100000">100,000원 권</option>
                        </select>
                        <select name="bill_kspay" id="bill_kspay" class="bill_sel">
                            <option value="0">0매</option>
                            <option value="1">1매</option>
                            <option value="2">2매</option>
                            <option value="3">3매</option>
                            <option value="4">4매</option>
                            <option value="5">5매</option>
                        </select>
                    </li>
                    <li class="btn">
                        <div class="btn_buy_mileage" onclick="fnMileGift('kspay', '3245', '418791970741de63073a73fc3fe93995');">구매하기</div>
                    </li>
                </ul>
                <ul class="gift_buy g_sideway">
                    <li class="product_img"> <span class="sp_mr oncash">온캐시</span> </li>
                    <li class="product_name f_black2 f_bold"> 온캐시 </li>
                    <li class="select_gift">
                        <select name="oncash" id="oncash">
                            <option value="3000">3,000원 권</option>
                            <option value="5000">5,000원 권</option>
                            <option value="10000">10,000원 권</option>
                        </select>
                        <select name="bill_oncash" id="bill_oncash" class="bill_sel">
                            <option value="0">0매</option>
                            <option value="1">1매</option>
                            <option value="2">2매</option>
                            <option value="3">3매</option>
                            <option value="4">4매</option>
                            <option value="5">5매</option>
                        </select>
                    </li>
                    <li class="btn">
                        <div class="btn_buy_mileage" onclick="fnMileGift('oncash', '3245', 'effa2ad566d01662d4086e9b01600380');">구매하기</div>
                    </li>
                </ul>
                <ul class="gift_buy g_sideway">
                    <li class="product_img"> <span class="sp_mr happy">해피머니</span> </li>
                    <li class="product_name f_black2 f_bold"> 해피머니 </li>
                    <li class="select_gift">
                        <select name="happy" id="happy">
                            <option value="1000">1,000원 권</option>
                            <option value="3000">3,000원 권</option>
                            <option value="5000">5,000원 권</option>
                            <option value="10000">10,000원 권</option>
                            <option value="30000">30,000원 권</option>
                            <option value="50000">50,000원 권</option>
                        </select>
                        <select name="bill_happy" id="bill_happy" class="bill_sel">
                            <option value="0">0매</option>
                            <option value="1">1매</option>
                            <option value="2">2매</option>
                            <option value="3">3매</option>
                            <option value="4">4매</option>
                            <option value="5">5매</option>
                        </select>
                    </li>
                    <li class="btn">
                        <div class="btn_buy_mileage" onclick="fnMileGift('happy', '3245', '9c517d7091c2e237930d66e8b7dba23a');">구매하기</div>
                    </li>
                </ul>
                <ul class="gift_buy g_sideway">
                    <li class="product_img"> <span class="sp_mr google">구글플레이기프트코드</span> </li>
                    <li class="product_name f_black2 f_bold"> 구글플레이기프트코드 </li>
                    <li class="select_gift">
                        <select name="googlegift" id="googlegift">
                            <option value="5000">5,000원 권</option>
                            <option value="10000">10,000원 권</option>
                            <option value="15000">15,000원 권</option>
                            <option value="30000">30,000원 권</option>
                            <option value="50000">50,000원 권</option>
                            <option value="100000">100,000원 권</option>
                            <option value="200000">200,000원 권</option>
                            <option value="300000">300,000원 권</option>
                            <option value="500000">500,000원 권</option>
                        </select>
                        <select name="bill_googlegift" id="bill_googlegift" class="bill_sel">
                            <option value="0">0매</option>
                            <option value="1">1매</option>
                            <option value="2">2매</option>
                            <option value="3">3매</option>
                            <option value="4">4매</option>
                            <option value="5">5매</option>
                        </select>
                    </li>
                    <li class="btn">
                        <div class="btn_buy_mileage" onclick="fnMileGift('googlegift', '3245', '');">구매하기</div>
                    </li>
                </ul>
            </div>
            <form method="post" id="frm">
                <input type="hidden" name="code" id="code">
                <input type="hidden" name="money" id="money">
                <input type="hidden" name="bill" id="bill"> </form>
        </div>
        <div class="g_notice">알아두기</div>
        <ul class="g_notice_box1 g_list">
            <li>휴대폰 번호 인증 후 출금 서비스 이용이 가능하며, 출금 완료 후 문자 또는 카카오톡 알림이 발송됩니다.</li>
            <li>출금 후 TCash 캐시로 즉시 적립되며, 타인에게 보내기 또는 계좌 출금 서비스를 이용하실 수 있습니다.</li>
            <li>마일리지 출금 관련문의는 고객감동센터(1544-8278), Tcash APP 관련문의는 TCash 고객센터(1566-5749)로 문의하시기 바랍니다.</li>
        </ul>
    </div>
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
