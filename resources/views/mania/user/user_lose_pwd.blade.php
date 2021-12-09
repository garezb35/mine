@extends('layouts-mania.app')

@section('head_attach')
@endsection

@section('foot_attach')
@endsection

@section('content')
    <style>
        .g_title_txt {
            margin-top: 10px;
            margin-bottom: 20px;
        }
        .collapse_cont {
            width: 360px;
            margin: 16px auto;
        }
        .collapse_cont .div-each .part-title {
            width: 120px;
            font-size: 14px;
            line-height: 50px;
        }
        .collapse_cont .div-each .part-content {
            width: calc(100% - 120px);
            line-height: 50px;
        }
        .collapse_cont .div-each .part-content input {
            padding: 6px 10px !important;
            width: 100%;
            height: initial;
        }
        .div-each {
            width: 100%;
        }
        .reset-pwd-txt {
            font-size: 16px;
            text-align: center;
            margin-top: 40px;
            margin-bottom: 10px;
            font-weight: bold;
        }
    </style>

    <div class="g_container">
        <div class="g_title_txt f-30 align-center">
            비밀번호 찾기
        </div>
        <div class="f-20 align-center f-bold f-15">개인 정보 보안을 위해 회원님 본인인증 후 비밀번호를 찾으실 수 있습니다.</div>
        <div class="collapse_cont">
            <form name="frmMobile" id="frmMobile" action="" method="post">
                @csrf
                <input type="hidden" name="user_type" id="user_type" value="hp">
                @if ($user_pass)
                    <div class="reset-pwd-txt">비밀번호 재설정</div>
                    <div>
                        <div class="d-flex div-each">
                            <div class="part-title">비밀번호</div>
                            <div class="part-content">
                                <input type="password" class="g_text" name="user_pass1" maxlength="12" value="{{$user_pass1}}" required>
                            </div>
                        </div>
                        <div class="d-flex div-each">
                            <div class="part-title">재입력</div>
                            <div class="part-content">
                                <input type="password" class="g_text" name="user_pass2" maxlength="12" required>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="d-flex div-each">
                    <div class="part-title">이름</div>
                    <div class="part-content">
                        <input type="text" class="g_text" name="user_name" maxlength="12" value="{{$user_name}}" required>
                    </div>
                </div>
                <div class="d-flex div-each">
                    <div class="part-title">생년월일</div>
                    <div class="part-content">
                        <input type="text" class="g_text" name="user_birth" maxlength="10" value="{{$user_birth}}" placeholder="예)1999-01-01" >
                    </div>
                </div>
                <div class="d-flex div-each">
                    <div class="part-title">이메일</div>
                    <div class="part-content">
                        <input type="text" class="g_text" name="user_email" value="{{$user_email}}" placeholder="richman@email.com">
                    </div>
                </div>
                <div class="d-flex div-each">
                    <div class="part-title">아이디</div>
                    <div class="part-content">
                        <input type="text" class="g_text" name="user_id" value="{{$user_id}}" maxlength="20">
                    </div>
                </div>
                <div class="align-center" style="margin-top: 20px;">
                    <input type="submit" value="인증받기" class="btn_blue3 big_btn">
                </div>
            </form>
        </div>
    </div>
@endsection
