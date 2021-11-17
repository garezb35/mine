@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/user_leave/css/user_leave_form.css">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/myroom/user_leave/js/user_leave_form.js"></script>
@endsection
@section('content')
    <div class="g_container" id="g_CONTENT">
        @include('aside.myroom',['group'=>'exit'])
        <div class="g_content">
            <div class="g_title_blue noborder">
                회원<span>탈퇴</span>
            </div>

            <div class="g_subtitle">마일리지 및 포인트 정보</div>
            <table class="g_blue_table noborder">
                <colgroup>
                    <col width="33%">
                    <col width="33%">
                    <col width="*">
                </colgroup>
                <tbody>
                    <tr>
                        <th class="noborder bg-white">총 마일리지</th>
                        <th class="noborder bg-white">신용등급</th>
                        <th class="noborder bg-white">전체거래현황</th>
                    </tr>
                    <tr>
                        <td class="noborder text-center bg-white"><a href="/myroom/mileage/my_mileage/">350,515 원</a></td>
                        <td class="noborder text-center bg-white">VIP <a href="http://trade.itemmania.com/myroom/myinfo/credit_rating.html"><img src="http://img4.itemmania.com/images/myroom/user_leave/btn_calssbe.gif" width="109" height="20" alt="신용등급 혜택받기" title="신용등급 혜택받기"></a></td>
                        <td class="noborder text-center bg-white">907 점</td>
                    </tr>
                </tbody>
            </table>
            <div class="g_gray_border"></div>
            <div class="subtitle">메일 수신 및 기타 개인정보 등에 대한 불편으로 회원 탈퇴를 원하신다면, 아래의 방법으로 불편사항을 해결하실 수 있습니다.</div>
            <div class="cancel_area">
                <form id="cancelForm" name="cancelForm" method="post" action="./user_refuse_ok.php">
                    <div class="tb_cell1">
                        <label for="email_cancel"><input type="checkbox" class="g_checkbox" name="email" id="email_cancel"> 이메일 수신거부</label>
                        <label for="sms_cancel"><input type="checkbox" class="g_checkbox" name="sms" id="sms_cancel"> SMS 수신거부</label>
                        <label for="offer_cancel"><input type="checkbox" class="g_checkbox" name="offer" id="offer_cancel"> 정보제공동의 철회</label>
                    </div>
                    <div class="tb_cell2">
                        <input type="image" src="http://img2.itemmania.com/images/myroom/user_leave/btn_b_appl.gif" width="66" height="20" title="신청하기" class="g_image">
                    </div>
                </form>
            </div>
            <div class="g_black3_11">* 아이템매니아 고객센터(1544-8278)는 365일 24시간 운영됩니다.불편사항은 언제든지 연락 주시면, 최선을 다해 해결 되도록 노력하겠습니다.</div>

            <div class="g_subtitle">회원탈퇴 신청 정보</div>
            <form id="signForm" name="signForm" method="post" action="/myroom/user_leave/user_leave_cause">
                @csrf
                <input type="hidden" name="pMode" value="user_leave">
                <table class="g_blue_table">
                    <colgroup>
                        <col width="140">
                        <col width="240">
                        <col width="140">
                        <col width="240">
                    </colgroup>
                    <tbody><tr>
                        <th>아이디</th>
                        <td>pej***</td>
                        <th>이름</th>
                        <td>이장훈</td>
                    </tr>
                    <tr>
                        <th>비밀번호</th>
                        <td colspan="3"><input type="password" class="g_text" name="passwd" id="user_passwd" maxlength="30"></td>
                    </tr>
                    </tbody></table>
                <div class="g_btn">
                    <img src="http://img3.itemmania.com/images/myroom/user_leave/btn_drop_progress.gif" width="98" height="37" alt="탈퇴진행" class="first" onclick="_window.open('User_Leave_No','user_leave_trade.html?sell=3&amp;buy=3',450,234)" id="leave_no">		<a href="javascript:window.history.back();"><img class="g_button" src="http://img3.itemmania.com/images/btn/btn_cancel5.gif" width="98" height="37" alt="취소"></a>
                </div>
            </form>
            <div class="SpGroup top_box">
                <p class="top_title"><span class="ft_orange">회원탈퇴</span>안내</p>
                <p>
                    회원 탈퇴 시 회원님께서 보유하셨던 마일리지 및 포인트, 쿠폰, 무료이용권은 모두 삭제됩니다.<br>
                    회원 탈퇴 후 재가입시에는 신규회원으로 가입이 처리되며, 탈퇴 전의 회원정보와 거래정보 및 마일리지,<br>포인트 등 모든 정보는 복구되지 않습니다.
                </p>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
@endsection
<style>
    .g_gray_border{
        border: 1px solid #C0C0C0;
    }
</style>
