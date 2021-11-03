@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/mileage/my_mileage/css/index.css?700101" />
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type='text/javascript' src='/mania/myroom/mileage/payment/js/mile_gift.js?210323'></script>
    <script type='text/javascript'>
        var gsVersion = '2110141801';
        var _LOGINCHECK = '1';
    </script>
@endsection

@section('content')
<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    @include('mania.myroom.aside', ['group'=>'mileage', 'part'=>'my_mileage'])
    <div class="g_content">
        <!-- ▼ 타이틀 //-->
        <div class="g_title_blue"> 내 마일리지
            <ul class="g_path">
                <li>홈</li>
                <li>마이룸</li>
                <li>마일리지</li>
                <li class="select">내 마일리지</li>
            </ul>
        </div>
        <!-- ▲ 타이틀 //-->
        <!-- ▼ 메뉴탭 //-->
        <div class="g_tab">
            <div class="selected"><a href="/myroom/mileage/my_mileage/index.html">마일리지 현황</a></div>
            <div class=""><a href="/myroom/mileage/my_mileage/calendar.html">마일리지 달력보기</a></div>
            <div class=""><a href="/myroom/mileage/my_mileage/detail_list.html">상세내역보기</a></div>
        </div>
        <!-- ▲ 메뉴탭 //-->
        <!-- ▼ 마일리지 현황 //-->
        <table class="g_blue_table">
            <colgroup>
                <col width="210">
                <col width="210">
                <col width="210">
                <col/> </colgroup>
            <tr>
                <th rowspan="3"> 현재 마일리지
                    <br> ①+②+③ </th>
                <td rowspan="3"> <span class="f_red1 f_bold">245 원</span>
                    <br> <span class="f_small">- 유효기간 설정 : 0원</span>
                    <br> <span class="f_small">- 게임전용 : 0원</span>
                    <br> <img src="http://img3.itemmania.com/images/btn/btn_det_sell.gif" width="63" height="18" alt="자세히보기" class="g_button" onclick="_window.open('mile_detail', 'popup/mile_detail.html', 800, 300);"> </td>
                <th>① 사용 및 출금이 가능한 마일리지</th>
                <td>245 원</td>
            </tr>
            <tr>
                <th>② 사용만 가능한 마일리지</th>
                <td>0 원
                    <div id="limit_remain"></div>
                </td>
            </tr>
            <tr>
                <th>③ 출금 전용 마일리지</th>
                <td>0 원</td>
            </tr>
            <tr>
                <th rowspan="2"> 전체 마일리지
                    <br> ①+②+③+④+⑤ </th>
                <td rowspan="2" class="f_bold">3,245 원</td>
                <th>④ 거래에 사용중인 마일리지</th>
                <td>3,000 원</td>
            </tr>
            <tr>
                <th>⑤ 출금 요청중인 마일리지</th>
                <td>0 원</td>
            </tr>
        </table>
        <!-- ▲ 마일리지 현황 //-->
        <div class="tb_bt_txt">※ 현재 마일리지는 "거래에 사용중인 마일리지와 출금 요청중인 마일리지"를 제외한 마일리지 입니다.</div>
        <div class="g_btn">
            <a href="/myroom/mileage/guide/charge.html"> <img src="http://img4.itemmania.com/images/btn/btn_fill.gif" width="115" height="37" alt="마일리지 충전"> </a>
            <a href="/myroom/mileage/payment/payment_switch.html"> <img src="http://img2.itemmania.com/images/btn/btn_pay.gif" width="115" height="37" alt="마일리지 출금"> </a>
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
                        <div class="btn_buy_mileage" onclick="fnMileGift('kspay', '245', '418791970741de63073a73fc3fe93995');">구매하기</div>
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
                        <div class="btn_buy_mileage" onclick="fnMileGift('oncash', '245', 'effa2ad566d01662d4086e9b01600380');">구매하기</div>
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
                        <div class="btn_buy_mileage" onclick="fnMileGift('happy', '245', '9c517d7091c2e237930d66e8b7dba23a');">구매하기</div>
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
                        <div class="btn_buy_mileage" onclick="fnMileGift('googlegift', '245', '');">구매하기</div>
                    </li>
                </ul>
            </div>
            <form method="post" id="frm">
                <input type="hidden" name="code" id="code">
                <input type="hidden" name="money" id="money">
                <input type="hidden" name="bill" id="bill"> </form>
        </div>
        <!-- ▼ 알아두기 //-->
        <div class="g_title_notice">알아두기</div>
        <ul class="g_notice_box1 g_list">
            <li>사용 전용 마일리지(유효기간 有)는 이벤트나 기타 사유로 인해 지급된 마일리지로 사용 가능한 유효기간이 존재합니다.</li>
            <li>사용 전용 마일리지(유효기간 有/유효기간 無)는 마일리지 출금 및 상품권몰, M마일리지로 사용이 불가합니다.</li>
            <li>출금 전용 마일리지는 아이템 구매와 같은 서비스 이용이 불가하며 출금 서비스만 이용 가능합니다.</li>
        </ul>
        <!-- ▲ 알아두기 //-->
    </div>
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
