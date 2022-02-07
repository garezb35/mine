@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/message/css/index.css?190220">

    <script type="text/javascript" src="/angel/carsouel_plugin/js/carsouel_plugin.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/message/js/index.js"></script>
    <script>
        function checkGbox(){
           if($(".all_gbox").prop('checked'))
           {
                $(".angel_game_sel").prop('checked',true);
           }
           else{
               $(".angel_game_sel").prop('checked',false);
           }
        }
    </script>
@endsection

@section('content')

<div class="bg-white">
    <div>
        @include("angel.myroom.header")
    </div>
    <div @class('ml-10')>
        @include("aside.myroom",['group'=>'message'])
        <div @class('pagecontainer')>
            <ul class="react_nav_tab navs__pops">
                <li class='first @if(empty(Request::get('type')) && Request::get('type') != 'storage') selected @endif'><a href="/myroom/message/">신규메시지</a></li>
                <li @if(Request::get('type') == '거래')class="selected" @endif><a href="/myroom/message/?type=거래" > 거래메시지</a></li>
                <li @if(Request::get('type') == '관리자')class="selected" @endif><a href="/myroom/message/?type=관리자" >관리자메시지</a></li>
                <li><a href="/myroom/message/myqna_list">나의 질문과 답변</a></li>
                <li class='last @if(Request::get('type') == 'storage')selected @endif'><a href="/myroom/message/?type=storage">메시지보관함</a></li>
            </ul>
            <ul class="tab_sib">
                <li>
                    @if(Request::get('type') != 'storage')
                        <div @class('lh25')>
                            <img src="/angel/img/icons/inbox.png">
                            <a href='./?type=거래&state=1' class="font-weight-bold f-14">거래 메시지 <span>{{$order_message_count}}개</span></a>
                        </div>
                        <div @class('lh25')>
                            <img src="/angel/img/icons/inbox.png" >
                            <a href='./?type=관리자&state=1' class="font-weight-bold f-14">관리자 메시지 <span>{{$manager_message_count}}개</span></a>
                        </div>
                        @if(Request::get('type') != 'storage')
                            <div> <button onclick="$('#procType').val('save');$('#frmDeleteAll').submit();" class="bg-white hb25 border__gray text-center pl-5 pr-5">메시지 보관하기</button> <span class="text-orange"></span> </div>
                        @endif
                        <div @class('lh25')>
                            <span>
                                <input type="checkbox" class="all_gbox" onchange="checkGbox()"/>
                                <span @class('lh25')>전체</span>
                            </span>&nbsp;&nbsp;
                            <button  class="btn_white2 save pl-5 pr-5" onclick="$('#procType').val('delete');$('#frmDeleteAll').submit();">삭제</button>
                        </div>
                    @endif
                </li>
            </ul>
            <form id="frmDeleteAll" name="frmDeleteAll" action="" method="post">
                @csrf
                <input type="hidden" id="procType" name="procType" value="">
                <div @class('table-responsive')>
                    <table class="table-primary tb_list thbn tdbn">
                        <colgroup>
                            <col width="48">
                            <col width="47">
                            <col width="69">
                            <col />
                            <col width="145">
                        </colgroup>
                        <tr>
                            <th>선택</th>
                            <th>상태</th>
                            <th>종류</th>
                            <th>제목</th>
                            <th>도착일시</th>
                        </tr>
                        @foreach($message as $v)
                            <tr>
                                <td>
                                    @if($v['readed'] == 1)
                                        <input type="checkbox" name="message_id[]" value="{{$v['id']}}" class="angel_game_sel">
                                    @else
                                        <input type="checkbox" name="message_id[]" value="{{$v['id']}}" class="angel_game_sel" disabled>
                                    @endif
                                    <input type="hidden" name="message_date[]" value="{{date("Y-m-d H:i:s",strtotime($v['created_at']))}}">
                                    <input type="hidden" name="message_state[]" value="1"> </td>
                                <td>
                                    @if($v['readed'] == 0)
                                        <img src="/angel/img/icons/seller.png" alt="읽지않음" width="16">
                                    @else
                                        <img src="/angel/img/icons/inbox.png" alt="읽음" width="16">
                                    @endif
                                </td>
                                <td>{{$v['type']}}</td>
                                <td class="left max-width-150" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">{{$v['title']}}</td>
                                <td>{{date("Y-m-d H:i:s",strtotime($v['created_at']))}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </form>

            <div class="empty-high"></div>

            <div class="pagination__bootstrap">
                {{$message->links()}}
            </div>
        </div>
    </div>

    <div id="message_view" class="modal_dialog">
        <div class="modal__title"> 메시지
            <div class="modal__close" onclick="nodemonPopup.disable();"></div>
        </div>
        <div class="modal--content">
            <table class="table-primary">
                <colgroup>
                    <col width="120">
                    <col width="187">
                    <col width="120">
                    <col width="187">
                </colgroup>
                <tr>
                    <th>종류</th>
                    <td><span id="dvMessage_type"></span></td>
                    <th>날짜</th>
                    <td><span id="dvMessage_date"></span></td>
                </tr>
                <tr id="tr_none">
                    <th>거래번호</th>
                    <td><span id="dvMessage_id"></span></td>
                    <th class="continue">거래금액</th>
                    <td><span id="dvMessage_price"></span></td>
                </tr>
                <tr>
                    <th>제목</th>
                    <td colspan="3"><span id="dvMessage_title"></span></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="dvMessage_content"></div>
                    </td>
                </tr>
            </table>
            <div class="float-left">
                <a href="../../customer/" class="btn-default btn-suc">1:1 문의하기</a>
            </div>
{{--            <div class="float-left" id="dvMessage_move"><span class="bold_txt"><a href="#">이전</a> | <a href="#">다음</a></span></div>--}}
            <div class="float__right">
                <a href="#" onclick="$.fnDelete();" class="btn-default btn-gray">삭제</a>
            </div>
        </div>
    </div>

    <div class="empty-high"></div>
</div>

@endsection
