@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type='text/css' rel='stylesheet' href='/mania/myroom/mileage/payment/css/payment_list.css?v=210524'>
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
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
        <!-- ▼ 메뉴탭 //-->
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
            <div class=" icon_new"> <a href="http://trade.itemmania.com/myroom/mileage/payment/payment_phone.html">휴대폰번호 출금</a> </div>
            <div class="selected"><a href="http://trade.itemmania.com/myroom/mileage/payment/payment_list.html">마일리지 출금내역 보기</a></div>
            <div class=" icon_new"><a href="http://trade.itemmania.com/myroom/mileage/payment/payment_phone_list.html">휴대폰번호 출금내역 보기</a></div>
        </div>
        <!-- ▲ 메뉴탭 //-->
        <div class="g_big_box1">
            <input type="radio" id="payment_1" name="payment_1" value="today" class="g_radio" checked onclick="location.href='payment_list.html';">
            <label for="payment_1">최근 마일리지 출금 현황</label>
            <input type="radio" id="payment_3" name="payment_1" value="before" class="g_radio" onclick="location.href='payment_list.html?strMenu=before';">
            <label for="payment_3">이전 마일리지 출금 현황</label>
        </div>
        <!-- ▲ 메뉴탭 //-->
        <form id="frm_pay" name="frm_pay" action="" method="post">
            <div class="g_subtitle">최근 마일리지 출금 현황</div>
            <div class="g_big_box1">
                <div class="g_left">
                    <select id="year" name="year" class="g_hidden">
                        <option value="2021" selected>2021 년</option>
                        <option value="2020">2020 년</option>
                        <option value="2019">2019 년</option>
                        <option value="2018">2018 년</option>
                        <option value="2017">2017 년</option>
                        <option value="2016">2016 년</option>
                    </select>
                    <select name="month" class="g_hidden">
                        <option value="">전체</option>
                        <option value="1">1 월</option>
                        <option value="2">2 월</option>
                        <option value="3">3 월</option>
                        <option value="4">4 월</option>
                        <option value="5">5 월</option>
                        <option value="6">6 월</option>
                        <option value="7">7 월</option>
                        <option value="8">8 월</option>
                        <option value="9">9 월</option>
                        <option value="10">10 월</option>
                        <option value="11">11 월</option>
                        <option value="12">12 월</option>
                    </select>
                </div>
                <div class="g_right">
                    <input type="image" src="http://img3.itemmania.com/images/btn/btn_check1.gif" width="64" height="18" alt="조회하기"> </div>
            </div>
        </form>
        <div class="content">
            <table class="g_blue_table tb_list">
                <colgroup>
                    <col width="47">
                    <col width="61">
                    <col width="126">
                    <col />
                    <col width="110">
                    <col width="110">
                </colgroup>
                <tr>
                    <th class="first">번호</th>
                    <th>유형</th>
                    <th>요청금액</th>
                    <th>입금은행</th>
                    <th>신청일</th>
                    <th>출금완료일</th>
                </tr>
                <tr>
                    <td class="first">1</td>
                    <td class="f_blue1"><strong>즉시</strong></td>
                    <td>560,000원</td>
                    <td>경남은행 &nbsp;&nbsp;574210252189 &nbsp;&nbsp;이장훈</td>
                    <td>2021-10-13</td>
                    <td>2021-10-13</td>
                </tr>
            </table>
            <div class="tb_bt_txt">- 조회기간은 전년기준 5년까지 조회 가능합니다.</div>
            <div class="dvPaging">
                <ul class="g_paging">
                    <li class='start'><strong class="g_blue">1</strong></li>
                </ul>
            </div>
        </div>
        <div class="g_finish"></div>
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
                        <div class="btn_buy_mileage" onclick="fnMileGift('kspay', '', '418791970741de63073a73fc3fe93995');">구매하기</div>
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
                        <div class="btn_buy_mileage" onclick="fnMileGift('oncash', '', 'effa2ad566d01662d4086e9b01600380');">구매하기</div>
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
                        <div class="btn_buy_mileage" onclick="fnMileGift('happy', '', '9c517d7091c2e237930d66e8b7dba23a');">구매하기</div>
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
                        <div class="btn_buy_mileage" onclick="fnMileGift('googlegift', '', '');">구매하기</div>
                    </li>
                </ul>
            </div>
            <form method="post" id="frm">
                <input type="hidden" name="code" id="code">
                <input type="hidden" name="money" id="money">
                <input type="hidden" name="bill" id="bill"> </form>
        </div>
        <!-- ▼ 알아두기 //-->
        <div class="g_notice">알아두기</div>
        <ul class="g_notice_box1 g_list">
            <li>본인 명의의 계좌가 아닐 경우 마일리지 출금 신청이 불가합니다.</li>
            <li>본인이 아닌 가족명의의 통장으로 출금을 원하는 경우 가입 고객님과 가족관계임을 증명할 수 있는</li>
            <li class="list_non">3개월 이내 발급된 주민등록 등본 또는 가족 관계 확인서를 고객감동센터로 보내주시기 바랍니다.</li>
            <li class="list_non">고객감동센터 팩스 : 0505-247-8278 / 이메일 : <a href="mailto:itemmania@itemmania.co.kr"><span class="g_blue1_11">itemmania@itemmania.co.kr</span></a> </li>
        </ul>
        <!-- ▲ 알아두기 //-->
    </div>
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
