@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/_css/allgame.css" />
@endsection

@section('foot_attach')
    <script src="/angel/_js/hangul.js" type="text/javascript"></script>
<script>
    let l_filter = new Array();
    let jaum = ['ㄱ','ㄴ','ㄷ','ㄹ','ㅁ','ㅂ','ㅅ','ㅇ','ㅈ','ㅊ','ㅋ','ㅌ','ㅍ','ㅎ','ㄲ','ㄸ','ㅃ','ㅆ','ㅉ']
    for(let i = 0; i<=18;i++){
        l_filter[i] = {alias: jaum[i],data:[]};
    }
    ajaxRequest({
        url: "/api/game_list",
        dataType: "json",
        type: 'post',
        data:{api_token: a_token},
        success: function(res) {
            if(res.length > 1){
                res.forEach(function (item)
                {
                    if(item.text.trim() != '선택하세요')
                    {
                        var dis = Hangul.disassemble(item.text, true);
                        var cho = dis.reduce(function (prev, elem) { elem = elem[0] ? elem[0] : elem;
                            return prev + elem; }, ""); item.diassembled = cho.charAt(0);
                    }
                });
                res.forEach(function (item){
                    if(item.diassembled && item.diassembled.trim() != ''){
                        l_filter[jaum.indexOf(item.diassembled)].data.push(item);
                    }
                })
                for(let i = 0; i< l_filter.length;i++){
                    $(".wowmidli").append('<div class="wowlistall" id="JKDiv_'+i+'" style="display: block;">\
                        <p>'+l_filter[i].alias+'</p>\
                    <ul class="wowgamelistz">')

                    $(".wowmidli").append("</ul></div>")
                    if(l_filter[i].data.length > 0){
                        for(let chd =0 ;chd< l_filter[i].data.length;chd++){
                            $("#JKDiv_"+i).find(".wowgamelistz").append('<a href="javascript:goSearchGame('+l_filter[i].data[chd].id+',\''+l_filter[i].data[chd].text+'\')" title="'+l_filter[i].data[chd].text+'"><li>'+l_filter[i].data[chd].text+'</li></a>')
                        }
                    }
                }
            }
            heightResize()
        }
    })

    function goSearchGame(id,game){
        $('input[name="filtered_game_id"]').val(id);
        $('input[name="filtered_game_alias"]').val(game);
        $("#search-overlay-container").submit()
    }


    function ChangeDiv(divId,divName,zDivCount)
    {
        for(i=0;i<=zDivCount;i++)
        {
            if(divId=='all'){
                if(document.getElementById(divName+i)){
                    document.getElementById(divName+i).style.display="block";
                    var div = document.getElementById("F"+divName+i);
                    div.className = '';
                }
            }else{
                if(document.getElementById(divName+i)){
                    document.getElementById(divName+i).style.display="none";
                    var div = document.getElementById("F"+divName+i);
                    div.className = '';
                }
            }
        }
        if(divId=='all'){
            document.getElementById("FJKDiv_all").className = 'action';
            document.getElementById("JKDiv_hot").style.display="block";
        }else{
            document.getElementById(divName+divId).style.display="block";
            var div = document.getElementById("F"+divName+divId);
            div.className = 'action';
            document.getElementById("FJKDiv_all").className = '';
            document.getElementById("JKDiv_hot").style.display="none";
        }
    }

</script>
@endsection

@section('content')
    <div @class('bg-white')>
        <div></div>
        <div class="ml-10 mr-10">
            <div class="wowlistgj">
                <dl>
                    <dd class="wowregion" id="zimu">
                        <a id="FJKDiv_all" class="action" onclick="JavaScript:ChangeDiv('all','JKDiv_','18')" rel="nofollow"><span>All</span></a>
                        <a id="FJKDiv_0" onclick="JavaScript:ChangeDiv('0','JKDiv_','18')" rel="nofollow" class=""><span>ㄱ</span></a>
                        <a id="FJKDiv_1" onclick="JavaScript:ChangeDiv('1','JKDiv_','18')" rel="nofollow" class=""><span>ㄴ</span></a>
                        <a id="FJKDiv_2" onclick="JavaScript:ChangeDiv('2','JKDiv_','18')" rel="nofollow" class=""><span>ㄷ</span></a>
                        <a id="FJKDiv_3" onclick="JavaScript:ChangeDiv('3','JKDiv_','18')" rel="nofollow" class=""><span>ㄹ</span></a>
                        <a id="FJKDiv_4" onclick="JavaScript:ChangeDiv('4','JKDiv_','18')" rel="nofollow" class=""><span>ㅁ</span></a>
                        <a id="FJKDiv_5" onclick="JavaScript:ChangeDiv('5','JKDiv_','18')" rel="nofollow" class=""><span>ㅂ</span></a>
                        <a id="FJKDiv_6" onclick="JavaScript:ChangeDiv('6','JKDiv_','18')" rel="nofollow" class=""><span>ㅅ</span></a>
                        <a id="FJKDiv_7" onclick="JavaScript:ChangeDiv('7','JKDiv_','18')" rel="nofollow" class=""><span>ㅇ</span></a>
                        <a id="FJKDiv_8" onclick="JavaScript:ChangeDiv('8','JKDiv_','18')" rel="nofollow" class=""><span>ㅈ</span></a>
                        <a id="FJKDiv_9" onclick="JavaScript:ChangeDiv('9','JKDiv_','18')" rel="nofollow" class=""><span>ㅊ</span></a>
                        <a id="FJKDiv_10" onclick="JavaScript:ChangeDiv('10','JKDiv_','18')" rel="nofollow" class=""><span>ㅋ</span></a>
                        <a id="FJKDiv_11" onclick="JavaScript:ChangeDiv('11','JKDiv_','18')" rel="nofollow" class=""><span>ㅌ</span></a>
                        <a id="FJKDiv_12" onclick="JavaScript:ChangeDiv('12','JKDiv_','18')" rel="nofollow" class=""><span>ㅍ</span></a>
                        <a id="FJKDiv_13" onclick="JavaScript:ChangeDiv('13','JKDiv_','18')" rel="nofollow" class=""><span>ㅎ</span></a>
                        <a id="FJKDiv_14" onclick="JavaScript:ChangeDiv('14','JKDiv_','18')" rel="nofollow" class=""><span>ㄲ</span></a>
                        <a id="FJKDiv_15" onclick="JavaScript:ChangeDiv('15','JKDiv_','18')" rel="nofollow" class=""><span>ㄸ</span></a>
                        <a id="FJKDiv_16" onclick="JavaScript:ChangeDiv('16','JKDiv_','18')" rel="nofollow" class=""><span>ㅃ</span></a>
                        <a id="FJKDiv_17" onclick="JavaScript:ChangeDiv('17','JKDiv_','18')" rel="nofollow" class=""><span>ㅆ</span></a>
                        <a id="FJKDiv_18" onclick="JavaScript:ChangeDiv('18','JKDiv_','18')" rel="nofollow" class=""><span>ㅉ</span></a>
                    </dd>
                </dl>
            </div>
            <div class="wowmidli">
                <div class="wowlistall" id="JKDiv_hot" style="display: block;">
                    <p>즐겨찾는 게임</p>
                    <ul class="wowgamelistz">
                        @if(!empty($hot_games))
                        @foreach($hot_games as $h)
                                <a  href="javascript:goSearchGame({{$h['game']}}, '{{$h['fgame']['game']}}')" title="{{$h['fgame']['game']}}"><li>{{$h['fgame']['game']}}</li></a>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <form id="search-overlay-container" method="post" action="" onsubmit="return searchbarSubmit();" target="mainFrame" class="d-none">
        @csrf
        <input type="hidden" name="filtered_game_id" value="{{$filtered_game_id ?? ''}}">
        <input type="hidden" name="filtered_game_alias" value="{{$filtered_game_alias ?? ''}}">
        <input type="hidden" name="filtered_child_id" value="{{$filtered_child_id ?? ''}}">
        <input type="hidden" name="filtered_child_alias" value="{{$filtered_child_alias ?? ''}}">
        <input type="hidden" name="filtered_items" value="{{$filtered_items ?? ''}}">
        <div class="top_game_searchbar">
            <div class="search_area no-border">
                <input type="text" class="angel__text search_gs_name" name="searchGameServer" id="searchGameServer" title="게임검색" style="ime-mode:active" placeholder="게임명을 입력해주세요." autocomplete="off" data-gameserver="true">
            </div>
            <button type="submit" class="search__submit" id="search__submit" title="검색"><i @class('fa fa-search')></i></button>
            <div class="gameWindowPopup d-none">
                <div class="gameTypePopup align-center">
                    <input type="radio" id="search_type1" name="search_type" value="sell" @if(empty($_POST['search_type']) || $_POST['search_type'] != 'buy') checked @endif style="display: none">
                    <input type="radio" id="search_type2" name="search_type" value="buy" @if(!empty($_POST['search_type']) && $_POST['search_type'] == 'buy') checked @endif style="display: none">

                </div>
                <div class="_34Cr45d_reacts">
                    <div class="tab searchbar_tab">
                        <div class="active"> <a href="javascript:;" data-target="tab_lastsearch">최근검색게임</a> </div>
                        <div> <a href="javascript:;" data-target="tab_mygame">즐겨찾는 게임</a> </div>
                    </div>
                    <div class="tab_content">
                        <div class="tab_child show" data-content="tab_lastsearch">
                            <ul class="recent_viewd_games"></ul>
                        </div>
                        <div class="tab_child" data-content="tab_mygame">
                            <ul class="mysearch_filters"></ul>
                        </div>
                    </div>
                </div>
                <div class="angel__menugames d-none" data-gslist="true"></div>
            </div>
        </div>
    </form>
@endsection
