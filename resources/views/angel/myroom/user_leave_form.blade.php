@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/user_leave/css/user_leave_form.css">
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/user_leave/js/user_leave_form.js"></script>
@endsection
@section('content')
    <style>
        .tb_cell1 label {
            margin-left: 32px;
            font-size: 14px;
        }
        .tb_cell1 {
            padding-top: 10px;
            line-height: 28px;
            border: none;
            width: 100%;
            height: initial;
        }
        .cancel_area {
            background-color: #f7f7f7;
        }
        .tb_cell2 input {
            margin-top: 10px;
            margin-bottom: 14px;
            padding: 6px 10px;
            border: solid 1px #067c97;
            color: #067c97;
            background: transparent;
        }
        .leave-action input {
            padding: 6px 12px;
            border: solid 1px gray;
            font-weight: bold;
            background-color: #dfdfdf;
        }
        .g_sky_table tr th {
            padding-top: 15.5px;
            padding-bottom: 15.5px;
        }
    </style>
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
                        <td class="noborder text-center bg-white"><a href="/myroom/mileage/my_mileage/">{{number_format($user['mileage'])}} 원</a></td>
{{--                        <td class="noborder text-center bg-white">VIP <a href="http://trade.itemmania.com/myroom/myinfo/credit_rating><img src="http://img4.itemmania.com/images/myroom/user_leave/btn_calssbe.gif" width="109" height="20" alt="신용등급 혜택받기" title="신용등급 혜택받기"></a></td>--}}
                        <td class="noborder text-center bg-white">VIP</td>
                        <td class="noborder text-center bg-white">907 점</td>
                    </tr>
                </tbody>
            </table>
            <div class="g_gray_border"></div>
            <div class="subtitle">메일 수신 및 기타 개인정보 등에 대한 불편으로 회원 탈퇴를 원하신다면, 아래의 방법으로 불편사항을 해결하실 수 있습니다.</div>
            <div class="d-flex">
                <div class="cancel_area" style="width: 200px;">
                    <form id="cancelForm" name="cancelForm" method="post" action="./user_refuse_ok.php">
                        <div class="tb_cell1">
                            <label for="email_cancel"><input type="checkbox" class="g_checkbox" name="email" id="email_cancel"> 이메일 수신거부</label><br>
                            <label for="sms_cancel"><input type="checkbox" class="g_checkbox" name="sms" id="sms_cancel"> SMS 수신거부</label><br>
                            <label for="offer_cancel"><input type="checkbox" class="g_checkbox" name="offer" id="offer_cancel"> 정보제공동의 철회</label><br>
                        </div>
                        <div class="tb_cell2 w-100">
                            <input type="submit" class="" width="66" height="20" value="신청하기" />
{{--                            <input type="image" src="http://img2.itemmania.com/images/myroom/user_leave/btn_b_appl.gif" width="66" height="20" title="신청하기" class="g_image">--}}
                        </div>
                    </form>
                </div>
                <div style="width: calc(100% - 212px); margin-left: 12px;">
                    <form id="signForm" name="signForm" method="post" action="/myroom/user_leave/user_leave_cause">
                        @csrf
                        <input type="hidden" name="pMode" value="user_leave">
                        <table class="g_blue_table g_sky_table">
                            <colgroup>
                                <col width="140">
                                <col width="240">
                                <col width="140">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>아이디</th>
                                    <td>pej***</td>
                                    <td rowspan="3" class="leave-action">
                                        <div class="align-center">
                                            <input type="submit" value="탈퇴진행">
                                        </div>
                                        <div class="align-center">
                                            <input type="reset" value="취소" style="padding: 6px 25px;margin-top: 12px;">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>이름</th>
                                    <td>{{$user['first_name'].$user['last_name']}}</td>
                                </tr>
                                <tr>
                                    <th>비밀번호</th>
                                    <td><input type="password" class="g_text" name="passwd" id="user_passwd" maxlength="30"></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>

            <div class="g_subtitle f-16"><span class="ft_orange">회원탈퇴</span>안내</div>
            <div style="border: solid 1px #bbb;padding: 12px 15px;">
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
