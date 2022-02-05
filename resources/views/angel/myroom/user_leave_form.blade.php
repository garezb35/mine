@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/user_leave/css/user_leave_form.css">
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/user_leave/js/user_leave_form.js"></script>
@endsection
@section('content')
    <style>

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
            border: solid 1px #b6b6b6;
            color: #000;
            background: transparent;
            width: 100%;
            text-align: center;
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
    <div @class('bg-white')>
        <div>
            @include("angel.myroom.header")
        </div>
        <div @class('ml-10')>
            @include('aside.myroom',['group'=>'exit'])
            <div class="pagecontainer">
                <div @class('ext__part')>
                    <div class="position-relative">
                        <form id="signForm" name="signForm" method="post" action="/myroom/user_leave/user_leave_cause">
                            @csrf
                            <input type="hidden" name="pMode" value="user_leave">
                            <table class="table-primary">
                                <colgroup>
                                    <col width="150"/>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th>아이디</th>
                                    <td>pej***</td>
                                    {{--                                    <td rowspan="3" class="leave-action">--}}

                                    {{--                                    </td>--}}
                                </tr>
                                <tr>
                                    <th>이름</th>
                                    <td>{{$user['first_name'].$user['last_name']}}</td>
                                </tr>
                                <tr>
                                    <th>비밀번호</th>
                                    <td><input type="password" class="angel__text" name="passwd" id="user_passwd" maxlength="30" autofocus></td>
                                </tr>
                                </tbody>
                            </table>
                            <div @class('ext_cancel')>
                                <input type="submit" value="탈퇴진행" @class('btn-endsb') style="border: 1px solid #a5a5a5 !important">
                                <input type="reset" value="취소" @class('btn-endsb')>
                            </div>
                        </form>
                    </div>
                    <div class="cancel_area">
                        <form id="cancelForm" name="cancelForm" method="post" action="./user_refuse_ok.php">
                            <div class="tb_cell1">
                                <label for="email_cancel"><input type="checkbox" class="angel_game_sel" name="email" id="email_cancel"> 이메일 수신거부</label><br>
                                <label for="sms_cancel"><input type="checkbox" class="angel_game_sel" name="sms" id="sms_cancel"> SMS 수신거부</label><br>
                                <label for="offer_cancel"><input type="checkbox" class="angel_game_sel" name="offer" id="offer_cancel"> 정보제공동의 철회</label><br>
                            </div>
                            <div class="tb_cell2 w-100">
                                <input type="submit" class="" width="66" height="20" value="신청하기" />
                            </div>
                        </form>
                    </div>
                </div>

                <div class="highlight_contextual_nodemon f-16 mt-20"><span>회원탈퇴</span>안내</div>
                <div>
                    <p>
                        회원 탈퇴 시 회원님께서 보유하셨던 마일리지 및 포인트, 쿠폰, 무료이용권은 모두 삭제됩니다.<br>
                        회원 탈퇴 후 재가입시에는 신규회원으로 가입이 처리되며, 탈퇴 전의 회원정보와 거래정보 및 마일리지,<br>포인트 등 모든 정보는 복구되지 않습니다.
                    </p>
                </div>
            </div>
        </div>
        <div class="empty-high"></div>
    </div>
@endsection
