
<!DOCTYPE html>
<html lang="ko">
    <head>
        <title>아이템천사</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=1920, initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="/angel/photoswipe/css/photoswipe.css">
        <link type="text/css" rel="stylesheet" href="/angel/photoswipe/css/default-skin/default-skin.css">
        <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css">
        <link type="text/css" rel="stylesheet" href="/angel/global_h/css/header_1.css">
        <link type="text/css" rel="stylesheet" href="/angel/carsouel_plugin/css/carsouel_plugin.css">
        <link type="text/css" rel="stylesheet" href="/angel/dev/global.css">
        <link type="text/css" rel="stylesheet" href="/angel/dev/change.css">
        <link type="text/css" rel="stylesheet" href="/angel/carsouel_plugin/css/carsouel.css">
        <link rel="stylesheet" href="/argon/select2/select2.min.css" />
        <script type="text/javascript" src="/angel/carsouel_plugin/js/carsouel_plugin.js"></script>
        <script type="text/javascript" src="/angel/socket/socket.io.js"></script>
        <script>
            var server_domain = '210.112.174.178';
            var a_token = '';
            var socket_client = io.connect('http://'+server_domain+':7443/adminWith', {
                path: '/socket.io',
                reconnectionAttempts:1,
                reconnectionDelay:500,
                reconnectionDelayMax:500,
                transports: ['websocket']
            });
        </script>
        @yield('head_attach')
    </head>
    <body>
    <script>

        @if(Auth::check())
        a_token = '{{Auth::user()->api_token}}';

         @else
        var a_token = '';

        @endif
        function basicPopup(url) {
            popupWindow = window.open(url,'popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
        }
    </script>
        <div id="global_root" class="mainEntity d-none">
            <div id="thirdys" class="fluid-div"></div>
        </div>
        <div class="topbar-left well well--tooltip" id="topbar-left">
            <div class="toobar-content" id="toobar-content">
                @if(auth()->check())
                    <div class="myinfo">
                        <div @class('tl__first')>
                            <div class='d-flex w-100 space-between'>
                                <div>
                                    <div class="rt_figure d-flex">
                                        <img src="/angel/img/level/{{$top_role['icon']}}">
                                        <div class="" style='padding-top: 12px;'>
                                            <div class='f-14'><span class='user_name f-14'>{{$me['name']}}</span> 고객님</div>
                                            <div class='f-14 f-bold'><span class='f-16' style='margin-left:10px;'>{{$top_role['alias']}}회원</span> ({{number_format($me['point'])}}점)</div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="other_link no-border">
                                        <div><a href="/myroom/my_mileage/index_c" class="head_charge">마일리지 충전</a></div>
                                        <div><a href="/myroom/my_mileage/index_e" class="head_give">마일리지 출금</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class='d-flex w-100'>
                                <div>
                                    <style>
                                        .tbl-myinfo,
                                        .tbl-myinfo tr,
                                        .tbl-myinfo td {
                                            border:  none !important;
                                        }
                                        .tbl-myinfo tr td {
                                            padding: 11px 0px;
                                            padding-right: 12px;
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>
                        <table class='tbl-myinfo'>
                            <colgroup>
                                <col width="120"/>
                            </colgroup>
                            <tr>
                                <td>
                                    <div class="text-white f-15 f-bold" style='margin-left: 16px;'>총 마일리지 </div>
                                </td>
                                <td>
                                    <div class="text-white f-15"><span class='f-16' style='color: #6bdaff; margin-left: 5px;'>{{number_format($me['mileage'])}}</span> 원</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <style>
                        .toobar-content .ing_count .ings > div {
                            width: 88px;
                        }
                    </style>
                    <div class="trade_list">
                        <table class="ing_count noborder text-white">
                            <colgroup>
                                <col width="80px"/>
                            </colgroup>
                            <tr class="sell">
                                <td class="c_txt sells align-left" >판매목록</td>
                                <td>등록</td>
                                <td><a href="/myroom/sell/sell_regist"><span class="text-blue_modern font-weight-bold">{{number_format($top_selling_register)}}</span>건</a></td>
                                <td>판매중</td>
                                <td><a href="/myroom/sell/sell_regist"><span class="text-blue_modern font-weight-bold">{{number_format($top_selling_count)}}</span>건</a></td>
                            </tr>
                            <tr class="buy">
                                <td @class('c_txt buys align-left')>구매목록</td>
                                <td>등록</td>
                                <td><a href="/myroom/buy/buy_regist"><span class="text-green_modern font-weight-bold">{{number_format($top_buying_register)}}</span>건</a></td>
                                <td>구매중</td>
                                <td><a href="/myroom/buy/buy_regist"><span class="text-green_modern font-weight-bold">{{number_format($top_buying_register)}}</span>건</a></td>
                            </tr>
                        </table>
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
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text cus-gray">$</span>
                                    </div>
                                    {!! Form::text('loginId', '', ["required"=>true,'class' => 'input-green form-control b-left-n text-white','autocomplete'=>"off"]) !!}
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text cus-gray">$</span>
                                    </div>
                                    {!! Form::password('password', ["required"=>true,'class'=>'input-green form-control b-left-n text-white']) !!}
                                </div>
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

                                <a class="text-white mr-2 f-12" href="{{ route('user_reg_step1') }}">회원가입</a>&nbsp;
                                <a class="text-white f-12" href="{{ route('user_lose_id') }}" target="mainFrame">아이디 찾기</a>&nbsp;
                                <a class="text-white f-12" href="{{ route('user_lose_pwd') }}" target="mainFrame">비밀번호 찾기</a>
                            </td>
                        </tr>
                    </table>
                    {!! Form::close() !!}
                    </form>
                @endif
            </div>
            <div class="favorite">
                <div class="s_title">
                    나만의 검색메뉴
                    <a href="/myroom/customer/search" style="margin-left: 15px"><i class="fa fa-cog"></i></a>
                </div>

                <a class="showing_fav font-weight-bold f_14" href="javascript:controlFavorite()"><i class="fa fa-plus"></i></a>
                <dl class="my_game" style="display: none" id="my_game">
                    @if(!empty($top_games))
                        @foreach($top_games as $t_g)
                            <dd title="{{$t_g['game_text']}}">
                                <span class="title-{{$t_g['type']}}"><img src="/angel/img/icons/{{$t_g['type']}}-i.png">-{{$t_g['type'] == 'sell' ? '팝니다':'삽니다'}}-</span>
                                <strong>{{$t_g['game_text']}} &gt; {{$t_g['server_text']}}</strong>
                                <div class="btn_area">
                                    <a href="/{{$t_g['type']}}/list_search?search_type={{$t_g['type']}}&amp;filtered_game_id={{$t_g['game']}}&amp;filtered_game_alias={{$t_g['game_text']}}&amp;filtered_child_id={{$t_g['server']}}&amp;filtered_child_alias={{$t_g['server_text']}}&amp;filtered_items={{itemAlias($t_g['goods_text'])}}">검색</a>
                                    <a href="/{{$t_g['type']}}?game={{$t_g['game']}}&amp;server={{$t_g['server']}}">등록</a>
                                </div>
                            </dd>
                        @endforeach
                    @endif
                </dl>
            </div>
            <div @class("bg-trans h--15")></div>
            <iframe scrolling="no" frameborder="0" width="100%" height="530" src="/box_chatting" id="chatFrame"></iframe>
            <div @class('phone__contact')>
                <p @class('ph__title')>전화 상담안내</p>
                <div @class('ph__content')>
                    <div>
                        <p @class('ph__title')>1532-9945</p>
                        <p @class('rest__part')>365일 24시간 연중무휴</p>
                    </div>
                </div>
            </div>
            <div @class('private__00')>
                <a href="/customer/report" @class('big_private__btn') >1:1이용문의</a>
            </div>
        </div>
        <div class="roots" id="angel" style="min-width: 1315px;">
            @include('layouts-angel.header')
            @yield('content')
            @include('layouts-angel.footer')
        </div>
        <script type="text/javascript" src="/angel/_js/jquery.js"></script>
        <script type="text/javascript" src="/angel/_js/webpack.js"></script>
        <script type="text/javascript" src="/angel/_js/angelic-global.js"></script>
        <script type="text/javascript" src="/angel/_js/loader.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/packery/1.4.3/packery.pkgd.min.js"></script>
        <script type="text/javascript" src="/angel/photoswipe/js/jquery.photoswipe-global.js"></script>
        <script type="text/javascript" src="/angel/_js/fed.min.js"></script>
        <script src="/argon/select2/select2.min.js"></script>
    @yield('foot_attach')

        <script type="text/javascript">
            loadGlobalItems()
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

</html>

<style>
    .siteHeader .js-nav-menu {
        padding: 0;
    }
    .container_fulids{
        min-height: 1086px;
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


    .well--tooltip::after {
        border-top-color: #f5f5f5;
        margin-top:  -1px;
    }


</style>
<script>

    function enterSearchList(id,game){
        $('input[name="filtered_game_id"]').val(id);
        $('input[name="filtered_game_alias"]').val(game);
        $("#search-overlay-container").submit()
    }

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
            if($(document).width() > 1313)
                $("#home__content").css('margin-left',($(document).width()-1305) / 2 + 320);
            var pos_left = $("#home__content").offset();
            $("#topbar-left").css("left",pos_left.left - 325 + "px")
            $("#topbar-left").css("top",pos_left.top + "px")
            @else
            if($(document).width() > 1313)
                $(".container_fulids").css('margin-left',($(document).width()-1305) / 2 + 320);
            var pos_left = $(".container_fulids").offset();
            $("#topbar-left").css("left",pos_left.left - 325 + "px")
            $("#topbar-left").css("top",10 + "px")
            @endif


        $(".dropdown").hover(
            function() {
                $('.dropdown-menu').stop( true, true ).slideDown("fast");
                $(this).toggleClass('open');
            },
            function() {
                $('.dropdown-menu').stop( true, true ).slideUp("fast");
                $(this).toggleClass('open');
            }
        );

        $(".drop-menu-right li a").click(function(){
            var id = $(this).data('id');
            var name = $(this).data('name');
            $('input[name="filtered_game_id"]').val(id);
            $('input[name="filtered_game_alias"]').val(name);
            $('#search-overlay-container').submit()
        })

    })
</script>

