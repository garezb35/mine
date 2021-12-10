
<!DOCTYPE html>
<html lang="ko">
    <head>
        <title>taxify</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="/mania/photoswipe/css/photoswipe.css">
        <link type="text/css" rel="stylesheet" href="/mania/photoswipe/css/default-skin/default-skin.css">
        <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css">
        <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css">
        <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css">
        <link type="text/css" rel="stylesheet" href="/mania/dev/global.css">
        <link type="text/css" rel="stylesheet" href="/mania/dev/change.css">
        @yield('head_attach')

    </head>

    <body>
    <script>
        var server_domain = '210.112.174.178';
        var a_token = '';
        @if(Auth::check())
        a_token = '{{Auth::user()->api_token}}';
        var _LOGINCHECK = '1';
         @else
        var a_token = '';
        var _LOGINCHECK = '0';
        @endif
        function basicPopup(url) {
            popupWindow = window.open(url,'popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
        }
    </script>
        <div id="g_SLEEP" class="g_sleep g_hidden">
            <div id="g_OVERLAY" class="g_overlay"></div>
        </div>
        <div class="g_body" id="g_BODY">
            @include('layouts-mania.header')
            @yield('content')
            @include('layouts-mania.footer')
        </div>
        <script type="text/javascript" src="/mania/_js/_jquery3.js"></script>
        <script type="text/javascript" src="/mania/_js/_comm.js"></script>
        <script type="text/javascript" src="/mania/_js/_gs_control_200924.js"></script>
        <script type="text/javascript" src="/mania/_js/_common_initialize_new.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/packery/1.4.3/packery.pkgd.min.js"></script>
        <script type="text/javascript" src="/mania/photoswipe/js/jquery.photoswipe-global.js"></script>
    @yield('foot_attach')

        <script type="text/javascript">
            _initialize();
        </script>
        <style>
            .pt-1 {
                padding-top: 0.25rem!important;
            }
            .box-menus td {
                padding-top: 0px;
            }
        </style>
    </body>
    <div class="topbar-left well well--tooltip" id="topbar-left">
        <div class="quickmenu_cont" id="quickmenu_cont">
            @if(auth()->check())
            <div class="myinfo">
                <div style='padding: 0 10px;'>
                    <div class='d-flex w-100'>
                        <div style='width: calc(100% - 78px);'>
                            <div class="rt_figure d-flex">
                                <img src="/mania/img/level/silver.png">
                                <div class="" style='padding-top: 12px;'>
                                    <div class='f-14'><span class='user_name f-14'>{{$me['name']}}</span> 고객님</div>
                                    <div class='f-14 f-bold' style='color: #626262;'><span class='f-16' style='margin-left:10px;'>VIP회원</span> ({{number_format($me['point'])}}점)</div>
                                </div>
                            </div>
                        </div>
                        <div style='width: 78px;'>
                            <div class="other_link no-border">
                                <div><a href="/myroom/my_mileage/index_c" class="head_charge">충전</a></div>
                                <div><a href="/myroom/my_mileage/index_e" class="head_give">출금</a></div>
                            </div>
                        </div>
                    </div>
                    <div class='d-flex w-100'>
                        <div style='width: calc(100% - 78px);'>
                            <style>
                                .tbl-myinfo,
                                .tbl-myinfo tr,
                                .tbl-myinfo td {
                                    border:  none !important;
                                }
                                .tbl-myinfo tr td {
                                    padding: 2px 0px;
                                    padding-right: 12px;
                                }
                            </style>
                            <table class='tbl-myinfo'>
                                <tr>
                                    <td>
                                        <div class="f_black1 f-15 f-bold" style='margin-left: 4px;'>총 마일리지 </div>
                                    </td>
                                    <td>
                                        <div class="f_black1 f-15 f-bold align-right"><span class='f-16' style='color: #159efd; margin-left: 5px;'>{{number_format($me['mileage'])}}</span> 원</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="f_black1 f-15 f-bold" style='margin-left: 4px;'>무료쿠폰 </div>
                                    </td>
                                    <td align='right'>
                                        <div class="f_black1 f-15 f-bold align-right"><span class='f-16' style='color: #159efd; margin-left: 5px;'>10</span> 장</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div style='width: 78px;'>
                            <div><span class="cert_state f_black1">@if($me['mobile_verified'] == 1)<img src="/mania/img/icons/icon_check.png">@endif 휴대폰</span></div>
                            <div><span class="cert_state f_black1">@if($me['bank_verified'] == 1)<img src="/mania/img/icons/icon_check.png">@endif &nbsp;계좌</span></div>
                        </div>
                    </div>
                </div>
                <!-- <dl class="status">
                    <dd class="credir_rt">
                        <div class="rt_figure">
                            <img src="/mania/img/level/silver.png">
                        </div>
                        <div class="user_name">{{$me['name']}}
                            <span class="cert">
                                <span class="cert_state f_black1">@if($me['mobile_verified'] == 1)<img src="/mania/img/icons/icon_check.png">@endif 휴대폰</span>
                                <span class="cert_state f_black1">@if($me['bank_verified'] == 1)<img src="/mania/img/icons/icon_check.png">@endif &nbsp;계좌</span>
                                <span class="cert_state f_black1">@if(!empty($me['email_verified_at']))<img src="/mania/img/icons/icon_check.png">@endif &nbsp;이메일</span>
                            </span>
                        </div>
                        <span class="rank _txt">
                            {{$top_role['alias']}} &nbsp;&nbsp;
                            <span class="f_blue1 f_bold f-16">
                                {{number_format($me['point'])}}
                                <dl class="milage">
                                    <dt class="f_black1">총 마일리지</dt>
                                    <dd>{{number_format($me['mileage'])}}<span class="f_black1">원</span></dd>
                                </dl>
                            </span>
                        </span>
                    </dd>
                </dl>

                <div class="other_link">
                    <a href="/myroom/my_mileage/index_c" class="head_charge">충전</a>
                    <a href="/myroom/my_mileage/index_e" class="head_give">출금</a>
{{--                    <a href="/myroom/" class="head_myroom">마이룸</a>--}}
                </div>-->
                <table class="table box-menus mar-t-5 mb-0">
                    <colgroup>
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <td class="text-center align-middle active pt-1 pb-1 border-right-ja">
                                <a href="/myroom">
                                    <div class="position-relative  text-center">
                                        <div class="mb-1  text-center">
                                            <i class="fa fa-home"></i>
                                        </div>
                                        마이룸
                                    </div>
                                </a>
                            </td>
                            <td class="text-center align-middle pt-1 pb-1 border-right-ja">
                                <a href="/myroom/message/">
                                    <div class="position-relative  text-center">
                                        <div class="mb-1  text-center">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        쪽지
                                        @if($msg_count > 0)
                                        <div class="itemCntBox" id="mail-count" >{{number_format($msg_count)}}</div>
                                        @else
                                        <div class="itemCntBox" id="mail-count" style="display:none">0</div>
                                        @endif

                                    </div>
                                </a>
                            </td>
                            <td class="text-center align-middle pt-1 pb-1 border-right-ja">
                                <div class="position-relative  text-center">
                                    <a href="#">
                                        <div class="mb-1  text-center">
                                            <i class="fa fa-gift" aria-hidden="true"></i>
                                        </div>
                                        아이템
                                    </a>
                                </div>
                            </td>
                            <td class="text-center align-middle pt-1 pb-1">
                                <a href="/logout">
                                    <div class="position-relative  text-center">
                                        <div class="mb-1  text-center">
                                            <i class="fa fa-power-off" aria-hidden="true"></i>
                                        </div>
                                        로그아웃
                                    </div>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="trade_list">
                <ul class="ing_count">
                    <li class="sell">
                        <span class="c_txt sells">판매목록</span>
                        <div class="qbox">
                            <div class="ings">
                                <div>
                                    <span class="mr-15">판매등록</span>
                                    <span><a href="/myroom/sell/sell_regist"><span class="f_blue1 f_bold">{{number_format($top_selling_register)}}</span>건</a></span>
                                </div>
                                <div>
                                    <span class="mr-15">흥정신청</span>
                                    <span><a href="/myroom/sell/sell_check"><span class="f_blue1 f_bold">{{number_format($top_bargain_request)}}</span>건</a></span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="buy">
                        <span class="c_txt buys">구매목록</span>
                        <div class="qbox">
                            <dl class="ings">
                                <div>
                                    <span class="mr-15">구매등록</span>
                                    <span><a href="/myroom/buy/buy_regist"><span class="f_green1 f_bold">{{number_format($top_buying_register)}}</span>건</a></span>
                                </div>
                            </dl>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="favorite">
                <div class="s_title">
                    나만의 검색메뉴
                    <a href="/myroom/customer/search" style="margin-left: 15px"><i class="fa fa-cog"></i></a>
                </div>

                <a class="showing_fav f_bold f_14" href="javascript:controlFavorite()"><i class="fa fa-plus"></i></a>
                <dl class="my_game" style="display: none" id="my_game">
                    @foreach($top_games as $t_g)
                    <dd title="{{$t_g['game_text']}}">
                        <span class="title-{{$t_g['type']}}"><img src="/mania/img/icons/{{$t_g['type']}}-i.png">-{{$t_g['type'] == 'sell' ? '팝니다':'삽니다'}}-</span>
                        <strong>{{$t_g['game_text']}} &gt; {{$t_g['server_text']}}</strong>
                        <div class="btn_area">
                            <a href="/{{$t_g['type']}}/list_search?search_type={{$t_g['type']}}&amp;search_game={{$t_g['game']}}&amp;search_game_text={{$t_g['game_text']}}&amp;search_server={{$t_g['server']}}&amp;search_server_text={{$t_g['server_text']}}&amp;search_goods={{itemAlias($t_g['goods_text'])}}">검색</a>
                            <a href="/{{$t_g['type']}}?game={{$t_g['game']}}&amp;server={{$t_g['server']}}">등록</a>
                        </div>
                    </dd>
                    @endforeach
                </dl>
            </div>
            @else
                {!! Form::open(['action' =>'App\Http\Controllers\LoginController@process_login', 'method' => 'post', 'enctype' => 'multipart/form-data','id'=>'login_form']) !!}
                <table class="ml-3 nobordertable">
                    <colgroup>
                        <col width="210px">
                        <col width="110px">
                    </colgroup>
                    <tr>
                        <td class="p-1">
                            {!! Form::text('loginId', '', ["required"=>true,'class' => 'input-green mb-1 w-100','autocomplete'=>"off"]) !!}
                            {!! Form::password('password', ["required"=>true,'class'=>'input-green w-100']) !!}
                        </td>
                        <td class="text-left p-1 pr-3">
                            {!! Form::submit('로그인', ['class' => 'btn btn-jin-greenoutline w-100 h-55']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2 pl-1" colspan="2">
                            @if(!empty($errors->first('failed')))
                                <div class="alert alert-danger mr-3 fade show alert-dismissible" role="alert">
                                    {{$errors->first('failed')}}
                                </div>
                            @endif

                            <a class="text-blue mr-2 f-12" href="{{ route('user_reg_step1') }}">회원가입</a>
                            <a class="text-blue f-12" href="{{ route('user_lose_id') }}" target="mainFrame">아이디</a>
                            <a class="text-blue f-12" href="{{ route('user_lose_pwd') }}" target="mainFrame">비밀번호 찾기</a>
                        </td>
                    </tr>
                </table>
                {!! Form::close() !!}
            </form>
            @endif
        </div>
        <iframe scrolling="no" frameborder="0" width="100%" height="450" src="/box_chatting" id="chatFrame"></iframe>
    </div>
</html>

<style>
    .g_header .g_snav {
        padding: 0;
    }
    .g_container{
        min-height: 730px;
    }
    .well--tooltip {
        min-width: 300px;
        max-width: 300px;
        margin: 0;
    }

    @media (min-width: 500px) {
        .well--tooltip {
            max-width: 380px;
        }
    }

    /* Tooltip Arrow */
    .well--tooltip::before,
    .well--tooltip::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -14px;
        width: 0;
        height: 0;
        border-left: 14px solid transparent;
        border-right: 14px solid transparent;
        border-top: 14px solid #cccccc;
    }
    .well--tooltip::after {
        border-top-color: #f5f5f5;
        margin-top:  -1px;
    }


</style>
<script>
    function controlFavorite() {
        $(".showing_fav").find("i").removeClass('fa-plus')
        $(".showing_fav").find("i").removeClass('fa-minus')
        var x = document.getElementById("my_game");
        if (x.style.display === "none") {
            x.style.display = "block";
            $(".showing_fav").find("i").addClass('fa-minus')
        } else {
            x.style.display = "none";
            $(".showing_fav").find("i").addClass('fa-plus')
        }
    }
    $(document).ready(function(){
        @if(request()->route()->getName() == "index")
            var pos_left = $(".top_full").offset();
            $("#topbar-left").css("left",pos_left.left - 325 + "px")
            $("#topbar-left").css("top",184 + "px")
        @else
            var pos_left = $(".g_container").offset();
            $("#topbar-left").css("left",pos_left.left - 325 + "px")
            $("#topbar-left").css("top",184 + "px")
        @endif
        if ($(window).width() < 1694){
            $("#quickmenu_area").show();
            $("#topbar-left").css("display","none")
            $("#topbar-left").css("position","fixed")
            $("#topbar-left").css("top","45px")
            $("#topbar-left").css("left","15px")
        }
        else{
            $("#quickmenu_area").hide();
        }
    })
</script>

