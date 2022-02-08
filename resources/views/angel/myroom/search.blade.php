@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/customer/css/search.css" />
@endsection

@section('foot_attach')
    <script type="text/javascript"  src="/angel/myroom/customer/js/search.js" ></script>
    <script type="text/javascript">
        function redirect(){
            location.reload()
        }
        $("#server_combo").select2({
            placeholder: '서버명',
            height: '30px',
            width: '320px'
        })
    </script>
@endsection
@section('content')
    <div @class('bg-white')>
        <div>
            @include("angel.myroom.header")
        </div>
        <div class="ml-10">
            @include('aside.myroom',['group'=>'settings'])
            <div class="pagecontainer">
                <div class="box" style="position: relative">
                    <form id="frm_search" method="post" action="/myroom/customer/search_add">
                        @csrf
                        <input type="hidden" name="type" value="{{Request::get('type') ?? 'sell'}}">
                        <div class="top_game_searchbar custom_search_wrapper">
                            <div class="gameTypePopup">
                                <a class="btn-endsb_search  {{empty(Request::get('type')) || Request::get('type') == 'sell' ? 'selected':''}}" href="/myroom/customer/search">팝니다</a>
                                <a class="btn-endsb_search {{Request::get('type') == 'buy' ? 'selected':''}}" href="/myroom/customer/search?type=buy">삽니다</a>
                            </div>
                            <div class="m-t-6">
                                <select id="server_combo" class="sel2" name="game">
                                    <option></option>
                                    @foreach($depth__0 as $d)
                                        <option value="{{$d['id']}}">{{$d['game']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="submit" class="search__submit" value="추가">
                        </div>
                    </form>
                </div>
                <div class="mine-game">
                    @foreach($list as $v)
                        <div>{{$v['game_text']}}{{$v['fgame']['game']}}<i data-text="{{$v['fgame']['game']}}" onclick="list_delete(this,'{{$v['id']}}');" class="fa fa-times" aria-hidden="true"></i></div>
                    @endforeach
                </div>
            </div>
            <div class="empty-high"></div>
        </div>
    </div>
@endsection

