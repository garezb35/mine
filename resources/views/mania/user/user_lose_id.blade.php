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
        .userid-part
        {
            font-size: 14px;
            background: #ebffeb;
            padding: 8px 6px;
        }
    </style>

    <div class="g_container">
        <div class="g_title_txt f-30 align-center">
            아이디 찾기
        </div>
        <div class="f-20 align-center f-bold f-15">개인 정보 보안을 위해 회원님 본인인증 후 아이디를 찾으실 수 있습니다.</div>
        <div class="collapse_cont">
            <form name="frmMobile" id="frmMobile" action="" method="post">
                @csrf
                <input type="hidden" name="user_type" id="user_type" value="hp">
                @if ($user_id != "")
                    <div class="userid-part">회원님의 아이디는 <b class="f-15">[ {{$user_id}} ]</b> 입니다.</div>
                @endif
                <div class="d-flex div-each">
                    <div class="part-title">이름</div>
                    <div class="part-content">
                        <input type="text" class="g_text" name="user_name" value="{{$user_name}}" maxlength="12" required>
                    </div>
                </div>
                <div class="d-flex div-each">
                    <div class="part-title">생년월일</div>
                    <div class="part-content">
                        <input type="text" class="g_text" name="user_birth" value="{{$user_birth}}" maxlength="10" placeholder="예)1999-01-01" >
                    </div>
                </div>
                <div class="d-flex div-each">
                    <div class="part-title">이메일</div>
                    <div class="part-content">
                        <input type="text" class="g_text" name="user_email" value="{{$user_email}}" placeholder="richman@email.com">
                    </div>
                </div>
                <div class="d-flex div-each">
                    <div class="part-title">전화번호</div>
                    <div class="part-content">
                        <input type="text" class="g_text" name="user_phone" value="{{$user_phone}}" placeholder="101-0000-0000">
                    </div>
                </div>
                <div class="align-center" style="margin-top: 20px;">
                    <input type="submit" value="인증받기" class="btn_blue3 big_btn">
                </div>
            </form>
        </div>
    </div>
@endsection
