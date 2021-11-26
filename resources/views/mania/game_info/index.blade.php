<!DOCTYPE html>
<html lang="ko">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="http://img1.itemmania.com/images/icon/favicon.ico">
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_popup.css">
    <link type='text/css' rel='stylesheet' href='/mania/game_info/money/css/index.css'>
    <style type='text/css'>#intro_title_box{display:none;} #lbl_gs_search{margin-top:-20px}</style>
    <script type="text/javascript" src="/mania/_js/_jquery3.js"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js"></script>
    <script>
        var gameName = new Array();
        var gameCode = new Array();
        var serverName = new Array();
        var serverCode = new Array();
        @php
            $key = 0;
        @endphp
            @foreach($game as $key1=>$g)
            @php
                $twokey = 0;
            @endphp
            @if(!empty($g['twegames']) && sizeof($g['twegames']) > 0)
            @else
            @php
                continue;
            @endphp
            @endif

         gameName[{{$key}}] = "{{$g['game']}}";
        gameCode[{{$key}}] = "{{$g['id']}}";
        serverCode[{{$g['id']}}] = new Array();
        serverName[{{$g['id']}}] = new Array();
        @foreach($g['twegames'] as $two)
            serverCode[{{$g['id']}}][{{$twokey}}] = "{{$two['id']}}";
        serverName[{{$g['id']}}][{{$twokey}}] = "{{$two['game']}}";
        @php
            $twokey++;
        @endphp
        @endforeach
        @php
            $key++;
        @endphp
        @endforeach
    </script>
</head>
<body>
    <div id="g_SLEEP" class="g_sleep g_hidden ">
        <div id="g_OVERLAY" class="g_overlay"></div>
    </div>
    <div id="g_BODY">
        <div id="popup_title_bar"><img src='http://img2.itemmania.com/images/gameinfo/titlep_gamemoney.gif' width='105' height='19' alt='게임머니 시세'></div>
        <div id="g_POPUP">
            <div class="g_content" style="float:none" >
                <!-- ▼ 타이틀 //-->
                <div id='intro_title_box'>
                    <div class="g_title_blue">
                        게임머니시세
                        <ul class="g_path">
                            <li>홈</li>
                            <li>게임정보</li>
                            <li class="select">게임머니시세</li>
                        </ul>
                    </div>
                    <div class="g_gray_border"></div>
                </div>
                <!-- ▲ 타이틀 //-->
                <div class="g_finish"></div>
                <div id="lbl_gs_search">
                    <div>
                        <img src="http://img2.itemmania.com/new_images/gameinfo/renew/img_potal_money_1.jpg">
                        <div class="search_wrapper">
                            <div id="search_text" class="g_black3">게임머니 시세 서비스를 제공하고 있습니다. 확인하고 싶은 게임 및 서버명을 선택하여 이용해 주세요.</div>
                            <form method="GET">
                                <ul class="g_sideway">
                                    <li>
                                        <select id="gamelist" name="gamecode">
                                            <option value="">게임을 선택해 주세요.</option>
                                        </select>
                                    </li>
                                    <li>
                                     <span id="serverlist_slt">
                                        <select id="serverlist" name="servercode">
                                           <option>서버를 선택해 주세요.</option>
                                        </select>
                                     </span>
                                    </li>
                                    <li><a href="javascript:;" id="btnView" class="btn-default btn-cancel">확인</a></li>
                                </ul>
                            </form>
                        </div>
                    </div>
                    <div class="g_finish"></div>
                </div>
                <div id="lbl_gs_search_rlt">
                    <div id="lbl_graph_title"></div>
                    <div id="lbl_graph_box">
                        <div id="lbl_graph">
                            <div class="graph_info" id="graph_info"></div>
                            <div id="graph_size_control">
                                <div id="loading_img" style="padding:100px;text-align: center;"><img src="http://img2.itemmania.com/images/icon/loadinfo.gif" width="24" height="24" alt=""></div>
                                <canvas id="container" width="780" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="dv_server_by">
                    <form id="exchanger">
                        <div class="g_subtitle_blue">환율변환</div>
                        <div id="exchanger_box">
                            <div>
                                <input type="text" id="txtMoney" name="txtMoney" maxlength="9" class="g_text">
                                <span id="txtUnitMoney" class="input_in_text">아데나 (만)</span>
                            </div>
                            <a href="javascript:exchange();" class="btn-default btn-suc">환산하기</a>
                            <img id="exchange_arrow" src="http://img2.itemmania.com/new_images/gameinfo/renew/ico_exchange.gif" alt="">
                            <div>
                                <input type="text" id="txtExchange" name="txtExchange" readonly="readonly" class="g_text">
                                <span class="input_in_text">원</span>
                            </div>
                            <span id="dvStandard"></span>
                        </div>
                    </form>
                    <div class="g_subtitle_blue" >일자 별 시세 등락 폭 </div>
                    <div id="money_list_box" >
                        <ul>
                            <li class="g_left">
                                <table class="tb_list">
                                    <tr>
                                        <th>날짜</th>
                                        <th>평균시세</th>
                                        <th>등락</th>
                                        <th>최저가</th>
                                    </tr>
                                    <tbody id="tbl_money_list_01">
                                    <tr>
                                        <td colspan="4"><img src="http://img3.itemmania.com/images/icon/loadinfo.gif" width="24" height="24" alt=""></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li class="g_right">
                                <table class="tb_list">
                                    <tr>
                                        <th>날짜</th>
                                        <th>평균시세</th>
                                        <th>등락</th>
                                        <th>최저가</th>
                                    </tr>
                                    <tbody id="tbl_money_list_02">
                                    <tr>
                                        <td colspan="4"><img src="http://img3.itemmania.com/images/icon/loadinfo.gif" width="24" height="24" alt=""></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </li>
                        </ul>
                        <div class="g_finish"></div>
                    </div>
                </div>
                <div id="dv_server_by_all" class="g_hidden">
                    <br>
                    <div id="byDay_list">
                        <a href="#" onclick="fnSearchGame('2021-11-24');"><img src="http://img3.itemmania.com/images/btn/btn_previous.gif"></a>
                        <span>2021년 11월 25일</span>
                        <a href="#"><img src="http://img3.itemmania.com/images/btn/btn_next1.gif"></a>
                        서버명을 클릭하시면 [팝니다] 물품리스트로 이동됩니다.
                    </div>
                    <div id="tbl_gs_list">
                        <ul>
                            <li class="g_left">
                                <table class="g_gray_table border_non">
                                    <tr>
                                        <th>서버명</th>
                                        <th>평균시세</th>
                                    </tr>
                                    <tbody id="tbl_gs_01">
                                    <tr>
                                        <td colspan="2"><img src="http://img4.itemmania.com/images/icon/loadinfo.gif" width="24" height="24" alt=""></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li class="g_left">
                                <table class="g_gray_table border_non">
                                    <tr>
                                        <th>서버명</th>
                                        <th>평균시세</th>
                                    </tr>
                                    <tbody id="tbl_gs_02">
                                    <tr>
                                        <td colspan="2"><img src="http://img4.itemmania.com/images/icon/loadinfo.gif" width="24" height="24" alt=""></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li class="g_left">
                                <table class="g_gray_table">
                                    <tr>
                                        <th>서버명</th>
                                        <th>평균시세</th>
                                    </tr>
                                    <tbody id="tbl_gs_03">
                                    <tr>
                                        <td colspan="2"><img src="http://img4.itemmania.com/images/icon/loadinfo.gif" width="24" height="24" alt=""></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </li>
                        </ul>
                        <div class="g_finish"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript' src='/mania/_js_chart/Chart.min.js'></script>
    <script type='text/javascript'>
        var bPop = '1';
        var g_game_code = '1';
        var g_game_code_name = '';
        var g_server_code = '2';
        var g_server_code_name = '';
        var g_cnt = '';
        var g_gs_name = '';
        var money_unit = '만';
        var money_date = '2021-11-25';
        var money_avg = '17400';
        var money_standard = '1000';
        var sType	= '';
        var sltDate = '2021-11-25';
        function fnSearchGame(snd){
            var strUrl = '/game_info/money/index?gamecode='+g_game_code+'&stype=all&sltDate='+snd;
            if(bPop){
                strUrl += '&win=pop';
            }
            location.href = strUrl;
        }
    </script><script type='text/javascript'>_window.resize(830, 1020)</script>

    <script type='text/javascript' src='/mania/game_info/money/js/index.js'></script>

    <script>_initialize();</script>
</body>
</html>
