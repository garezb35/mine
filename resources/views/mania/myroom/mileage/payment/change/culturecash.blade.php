@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/mileage/change/css/change.css?700101">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/mileage/change/culturecash/css/index.css?200203">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/myroom/mileage/change/culturecash/js/index.js?v=200203"></script>
    <script type='text/javascript'>
        var gsVersion = '2110141801';
        var _LOGINCHECK = '1';
    </script>
@endsection

@section('content')
<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    @include('mania.myroom.aside', ['group'=>'mileage', 'part'=>'change'])
    <div class="g_content">
        <div class="g_title_blue"> 마일리지 전환
            <ul class="g_path">
                <li>홈</li>
                <li>마이룸</li>
                <li>마일리지</li>
                <li class="select">마일리지 전환</li>
            </ul>
        </div>
        <ul class="top_menu">
            <li class=" on"> <a href="http://trade.itemmania.com/myroom/mileage/change/culturecash/">
                    컬쳐캐쉬<i class="img_charge34">컬쳐캐쉬</i>
                </a> </li>
            <li class=""> <a href="http://trade.itemmania.com/myroom/mileage/change/moneytree/">
                    머니트리<i class="img_charge33">머니트리</i>
                </a> </li>
        </ul>
        <div class="top_desc"> <img src="http://img4.itemmania.com/images/guide/mileage/img_acc_cl.gif" width="200" height="117" alt="">
            <dl class="top_desc_txt"> <dt class="g_org1_b">컬쳐캐쉬</dt>
                <dd>컬쳐 캐쉬는 다양한 온라인에서 사용 가능한 컬쳐랜드 포인트입니다.</dd>
                <dd>기존의 PIN 방식의 불편한 사용 방식을 개선하여, 원하는 금액을 한번에 PIN입력없이 충전할수 있습니다.</dd>
            </dl>
        </div>
        <div class="tabMenu">
            <div class="active"><a href="index.html">컬쳐캐시 전환</a></div>
            <div class=""><a href="exchange_list.html">컬쳐캐시 전환 내역</a></div> <a href="https://www.cultureland.co.kr/signin/findId/mobileAuth.do" target="_blank" class="sub_btn">컬쳐랜드 ID 찾기</a> </div>
        <!-- ▼ 마일리지 출금 정보 //-->
        <form id="frmCertify" name="frmCertify" method="post">
            <input type="hidden" id="security_type" name="security_type" value="INCS">
            <input type="hidden" id="certify_pay" name="certify_pay" value="YTo0OntzOjEwOiJjZXJ0aWZ5X2xjIjtzOjM6InBheSI7czo5OiJmb3JtX25hbWUiO3M6MTA6ImZybVBheW1lbnQiO3M6MTE6InN1Ym1pdF90eXBlIjtzOjE6IjEiO3M6MTA6InN1Ym1pdF91cmwiO3M6NDc6Ii9teXJvb20vbWlsZWFnZS9jaGFuZ2UvY3VsdHVyZWNhc2gvZXhjaGFuZ2UucGhwIjt9"> </form>
        <form id="frmPayment" name="frmPayment" method="post">
            <input type="hidden" name="total_mileage" id="total_mileage" value="3245">
            <input type="hidden" name="oid" id="oid">
            <div class="g_subtitle">전환신청</div>
            <table class="g_blue_table">
                <colgroup>
                    <col width="160">
                    <col>
                    <col width="160">
                    <col>
                </colgroup>
                <tr>
                    <th>총 마일리지</th>
                    <td colspan="3">3,245 원</td>
                </tr>
                <tr>
                    <th>전환가능 마일리지</th>
                    <td colspan="3"> <span id="mileage_total">245</span> 원 </td>
                </tr>
                <tr>
                    <th>전환할 마일리지</th>
                    <td colspan="3">
                        <input type="text" name="mileage" id="mileage" class="g_text" maxlength="13"> 원 <span class="f_small">(1회 1,000원 ~ 1,000,000원 이용 가능합니다.)</span> </td>
                </tr>
                <tr>
                    <th>전환할 컬쳐랜드 ID</th>
                    <td>
                        <input type="text" name="culture_id" id="culture_id" class="g_text" maxlength="13"> <a href="javascript:;" class="btn_ok" id="btn_culture_id">확인</a> </td>
                    <th>컬쳐랜드 가입자명</th>
                    <td> <span class="g_hidden">
                            <span id="culture_name"></span>
								<label for="cultureid_check" class="cultureid_check">
									<input type="radio" class="g_radio" name="cultureid_check" id="cultureid_check"> 명의 확인 체크 </label>
								</span>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3"> <span class="f_org1">※ 위 컬쳐랜드 ID로 컬쳐캐쉬가 충전됩니다.</span>
                        <br> ID 오기재로 인해 발생된 문제는 당사에서 책임지지 않습니다. </td>
                </tr>
                <tr>
                    <th colspan="4">충전 될 컬쳐캐시 : <span id="spnPayment_mileage" class="spnPayment_mileage">0</span> 원 </th>
                </tr>
            </table>
            <div class="g_btn_wrap"> <a href="javascript:;" class="exchange_btn" id="exchange_btn">전환하기</a> </div>
        </form>
        <!-- ▼ 알아두기 //-->
        <div class="g_notice">알아두기</div>
        <ul class="g_notice_box1 g_list">
            <li>컬쳐랜드 ID확인 5회 연속 실패 또는 다수의 ID확인시 서비스 이용이 제한됩니다.</li>
            <li>컬쳐랜드 ID당 월 한도 500만원까지 전환 가능합니다.</li>
            <li>컬쳐랜드 계정으로 즉시 충전됨으로 전환된 금액은 취소가 불가능합니다.</li>
            <li>전환내역은 마이룸 > 마일리지 > 마일리지전환 > 컬쳐캐시 전환 내역 메뉴에서 확인 가능합니다.</li>
            <li>전환된 컬쳐캐시의 사용 유효기간은 전환 시점에서 부터 1년입니다.</li>
        </ul>
        <!-- ▲ 알아두기 //-->
    </div>
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
