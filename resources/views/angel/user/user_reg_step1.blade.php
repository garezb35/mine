@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/carsouel_plugin/css/carsouel.css">
    <link type="text/css" rel="stylesheet" href="/angel/home/index.css">
    <link type="text/css" rel="stylesheet" href="/angel/home/custom.css">
@endsection

@section('foot_attach')
@endsection

@section('content')
    <style>
        .container_fulids {
            padding-top: 70px;
        }
        .g_title_txt {
            font-size: 24px;
            font-weight: bold;
        }
        .g_title_txt span {
            color: #0073DD;
        }
        .part-reg-step .div-each {
            width: 25%;
        }
        .part-reg-step {
            padding-top: 20px;
            padding-bottom: 60px;
        }
        .part-reg-step .div-each {
            background-color: #C4C4C4;
            height: 140px;
        }
        .part-reg-step .active {
            background-color: #3A79B4;
        }
        .part-reg-detail .part-text div {
            color: white;
            padding-top: 4px;
        }
        .part-reg-detail {
            padding-left: 45px;
            padding-top: 30px;
        }
        .part-reg-detail .part-text {
            padding-top: 12px;
            padding-left: 14px;
            letter-spacing: 0px;
        }
        .part-reg-detail .img-part img {
            display: inline-block;
            height: 100%;
            object-fit: contain;
        }
        .part-user-grade {
            margin-bottom: 120px;
        }
        .part-user-grade .div-each {
            width: 33.33%;
            height: 274px;
        }
        /*.part-user-grade .div-each-detail {*/
        /*    padding-top: 65px;*/
        /*    padding-left: 60px;*/
        /*}*/

        .div-each-detail{
            margin-top: 60px;
        }

        .div-each-detail .d-flex{
            justify-content: center;
        }
        .sub-text-title {
            font-size: 18px;
            font-weight: bold;
            padding-bottom: 16px;
        }
        .part-user-grade .part-text {
            padding-left: 16px;
            padding-top: 10px;
            width: 164px;
        }
        .btn-user-reg {
            padding: 6px 10px;
            font-size: 16px;
            background: white;
            border-radius: 4px;
            color: #3492d7;
            display: block;
            width: 80px;
            text-align: center;
            margin: auto;
            margin-top: 20px;
        }
        .btn-user-reg {
            background-color: white;
            transition: 0.3s;
        }
        .btn-user-reg:hover {
            background-color: #d0e5ff;
            color: black;
        }
        @media only screen and (max-width: 869px){
            .part-text{
                display: none;
            }
        }
    </style>
    <div @class('bg-white')>
        <div></div>
        <div @class('ml-10 mr-10')>
            <div class="g_title_txt">
                <span>????????????</span> ?????????
            </div>
            <div class="d-flex w-100 part-reg-step">
                <div class="div-each w-100 active">
                    <div class="d-flex part-reg-detail">
                        <div class="img-part">
                            <img src="/angel/img/icons/reg_step1.png" height="77" width="77" />
                        </div>
                        <div class="part-text">
                            <div class="f-15">STEP 01</div>
                            <div class="f-16">??????????????????</div>
                        </div>
                    </div>
                </div>
                <div class="div-each w-100">
                    <div class="d-flex part-reg-detail">
                        <div class="img-part">
                            <img src="/angel/img/icons/reg_step2.png" height="63" width="74" styl />
                        </div>
                        <div class="part-text">
                            <div class="f-15">STEP 02</div>
                            <div class="f-16">????????????</div>
                        </div>
                    </div>
                </div>
                <div class="div-each w-100">
                    <div class="d-flex part-reg-detail">
                        <div class="img-part">
                            <img src="/angel/img/icons/reg_step3.png" height="63" width="66" />
                        </div>
                        <div class="part-text">
                            <div class="f-15">STEP 03</div>
                            <div class="f-16">????????????</div>
                        </div>
                    </div>
                </div>
                <div class="div-each w-100">
                    <div class="d-flex part-reg-detail">
                        <div class="img-part">
                            <img src="/angel/img/icons/reg_step4.png" height="70" width="85" />
                        </div>
                        <div class="part-text">
                            <div class="f-15">STEP 04</div>
                            <div class="f-16">??????????????????</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sub-text-title">????????????</div>
            <div class="d-flex part-user-grade w-100">
                <div class="div-each" style="background: #3492D7;">
                    <div class="div-each-detail">
                        <div class="d-flex">
                            <div class="img-part">
                                <img src="/angel/img/icons/user_reg.png" width="87" height="76" />
                            </div>
                            <div class="part-text c-white">
                                <div class="user-grade-type f-24">????????????</div>
                                <hr>
                                <div class="user-grade-detail f-16">19??? ?????? ?????????</div>
                            </div>
                        </div>
                        <div>
                            <form action="{{route('user_reg_step2')}}" method="post">
                                @csrf
                                <input type="hidden" name="user_type" value="1" />
                                <input type="submit" class="btn-user-reg" value="????????????" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="div-each" style="background: #3C9F23;">
                    <div class="div-each-detail">
                        <div class="d-flex">
                            <div class="img-part">
                                <img src="/angel/img/icons/user_reg.png" width="87" height="76" />
                            </div>
                            <div class="part-text c-white">
                                <div class="user-grade-type f-24">???????????????</div>
                                <hr>
                                <div class="user-grade-detail f-16">19??? ?????? ?????????</div>
                            </div>
                        </div>
                        <div>
                            <form action="{{route('user_reg_step2')}}" method="post">
                                @csrf
                                <input type="hidden" name="user_type" value="3" />
                                <input type="submit" class="btn-user-reg" value="????????????" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="div-each" style="background: #2E9D97;">
                    <div class="div-each-detail">
                        <div class="d-flex">
                            <div class="img-part">
                                <img src="/angel/img/icons/user_reg.png" width="87" height="76" />
                            </div>
                            <div class="part-text c-white">
                                <div class="user-grade-type f-24">???????????????</div>
                                <hr>
                                <div class="user-grade-detail f-16">????????? ???????????? ?????????</div>
                            </div>
                        </div>
                        <div>
                            <form action="{{route('user_reg_step2')}}" method="post">
                                @csrf
                                <input type="hidden" name="user_type" value="3" />
                                <input type="submit" class="btn-user-reg" value="????????????" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
