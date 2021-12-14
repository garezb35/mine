@php
$item ='money';
if($goods_text == '아이템')
    $item = 'item';
if($goods_text == '기타')
    $item = 'etc';
if($goods_text == '캐릭터')
    $item = 'character';
if($goods_text == '물품전체')
    $item = 'all';
@endphp
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link type="text/css" rel="stylesheet" href="/angel/_css/_comm.css">
    <link type="text/css" rel="stylesheet" href="/angel/_head_tail/css/_head_popup.css">
    <link type="text/css" rel="stylesheet" href="/angel/myroom/customer/css/search_update_form.css">
</head>
<body>
<div id="g_SLEEP" class="g_sleep g_hidden">
    <div id="g_OVERLAY" class="g_overlay"></div>
</div>
<div id="g_BODY">
    <div class="myotp_id_layer_wrapper">
        <div class="inner"></div>
    </div>
    <div class="popup_title_bar"><img src="http://img3.itemmania.com/images/myroom/title/title_my_smenu.gif" alt="나만의 검색 메뉴 수정"></div>
    <div id="g_POPUP2">
        <div class="popup_icon">자주 거래하시는 물품 종류를 등록해 주세요. 간편하게 신규 물품을 확인/등록 할 수 있습니다.</div>
        <form id="frmSearch" action="/myroom/customer/search_update" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$id}}">
            <input type="hidden" name="game" value="{{$game}}">
            <input type="hidden" name="game_text" value="{{$game_text}}">
            <input type="hidden" name="server" value="{{$server}}">
            <input type="hidden" name="server_text" value="{{$server_text}}">
            <input type="hidden" name="goods_tmp" value="{{$item}}">
            <input type="hidden" name="goods" value="{{$goods}}">
            <input type="hidden" name="goods_text" value="{{$goods_text}}">
            <div class="box">
                <div class="g_search_wrapper custom_search_wrapper">
                    <select id="slctType" name="type" class="slctType">
                        <option value="sell" @if($type == 'sell')selected="selected"@endif>팝니다</option>
                        <option value="buy" @if($type == 'buy')selected="selected"@endif>삽니다</option>
                    </select>
                    <div class="search_area">
                        <input type="text" class="g_text search_gs_name" id="searchRegGameServer" placeholder="게임명 또는 서버명을 입력해주세요." autocomplete="off" data-gameserver="true">
                        <a href="javascript:;" class="delete_btn"></a>
                    </div>
                    <div class="g_search_frame g_hidden custom_gameserver" id="custom_gameserver">
                        <div class="gs_list gs_selection" data-gslist="true" id="custom_gameserver_list">
                        </div>
                    </div>
                </div>
            </div>
            <div class="g_btn">
                <input type="submit"  value="수정" class="btn-default-medium btn-suc-rect g_image" />
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="/angel/_js/jquery.js"></script>
<script type="text/javascript" src="/angel/_js/_comm.js"></script>
<script type="text/javascript" src="/angel/_js/angelic-global.js"></script>
<script type="text/javascript" src="/angel/myroom/customer/js/search_update_form.js"></script>
<script>
    _initialize();
    function redirect(){
        opener.redirect();
    }
</script>
</body>
</html>
