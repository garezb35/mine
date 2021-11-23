@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/myroom/message/css/index.css?190220">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/myroom/message/js/index.js"></script>
    <script>
        function checkGbox(){
           if($(".all_gbox").prop('checked'))
           {
                $(".g_checkbox").prop('checked',true);
           }
           else{
               $(".g_checkbox").prop('checked',false);
           }
        }
    </script>
@endsection

@section('content')
<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    @include('aside.myroom',['group'=>'message'])
    <div class="g_content">
        <div class="g_title_blue noborder">메세지함</div>
        <ul class="g_tab g_tab_myroom">
            <li class='first @if(empty(Request::get('type')) && Request::get('type') != 'storage') selected @endif'><a href="/myroom/message/">신규메시지</a></li>
            <li @if(Request::get('type') == '거래')class="selected" @endif><a href="/myroom/message/?type=거래" > 거래메시지</a></li>
            <li @if(Request::get('type') == '관리자')class="selected" @endif><a href="/myroom/message/?type=관리자" >관리자메시지</a></li>
            <li><a href="/myroom/message/myqna_list">나의 질문과 답변</a></li>
            <li class='last @if(Request::get('type') == 'storage')selected @endif'><a href="/myroom/message/?type=storage">메시지보관함</a></li>
        </ul>
        <ul class="tab_sib">
            <li class="g_left">
                @if(Request::get('type') != 'storage')
                 <img src="/mania/img/icons/inbox.png" width="27" height="16" style="vertical-align: bottom">
                <a href='./?type=거래&state=1' class="f_bold f-14">거래 메시지 <span>{{$order_message_count}}개</span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <img src="/mania/img/icons/inbox.png" width="27" height="16" style="vertical-align: bottom">
                <a href='./?type=관리자&state=1' class="f_bold f-14">관리자 메시지 <span>{{$manager_message_count}}개</span></a>
                @endif
            </li>
            <li class="g_right">
                <input type="checkbox" class="all_gbox" onchange="checkGbox()"/>&nbsp;&nbsp;전체&nbsp;&nbsp;
                <a href="javascript:;" class="btn_white2 save" onclick="$('#procType').val('delete');$('#frmDeleteAll').submit();">삭제</a>
            </li>
        </ul>
        <form id="frmDeleteAll" name="frmDeleteAll" action="" method="post">
            @csrf
            <input type="hidden" id="procType" name="procType" value="">
            <table class="g_blue_table tb_list">
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
                    <th>내용</th>
                    <th>도착일시</th>
                </tr>
                @foreach($message as $v)
                <tr>
                    <td>
                        @if($v['readed'] == 1)
                            <input type="checkbox" name="message_id[]" value="{{$v['id']}}" class="g_checkbox">
                            @else
                            <input type="checkbox" name="message_id[]" value="{{$v['id']}}" class="g_checkbox" disabled>
                        @endif
                        <input type="hidden" name="message_date[]" value="{{date("Y-m-d H:i:s",strtotime($v['created_at']))}}">
                        <input type="hidden" name="message_state[]" value="1"> </td>
                    <td>
                        @if($v['readed'] == 0)
                            <img src="/mania/img/icons/seller.png" alt="읽지않음" width="32">
                        @else
                            <img src="/mania/img/icons/order_icon.png" alt="읽음" width="32">
                        @endif
                    </td>
                    <td>{{$v['type']}}</td>
                    <td class="left" onclick="$.fnMessageAjax(this.parentNode,'new');" style="cursor:pointer">{{$v['content']}}</td>
                    <td>{{date("Y-m-d H:i:s",strtotime($v['created_at']))}}</td>
                </tr>
                @endforeach
            </table>
        </form>
        <!-- ▲ 메시지 확인 //-->
        @if(Request::get('type') != 'storage')
            <div class="tb_bt_txt"> <img src="http://img2.itemmania.com/images/btn/btn_msg_save.gif" width="85" height="20" onclick="$('#procType').val('save');$('#frmDeleteAll').submit();" class="g_button" alt="보관함에 저장"> <span class="f_org1">- 메시지는 올해를 제외한 이전 6개월만 보관되오니, 중요한 메시지는 보관함에 저장하시기 바랍니다.</span> </div>
        @endif
        <div class="g_finish"></div>
        <!-- ▼ 페이징 //-->
        <div class="dvPaging">
            {{$message->links()}}
        </div>
        <!-- ▲ 페이징 //-->
    </div>
    <!-- ▼ 메시지 레이어 //-->
    <div id="message_view" class="g_popup">
        <div class="layer_title"> 메시지
            <div class="btn_close" onclick="g_nodeSleep.disable();"></div>
        </div>
        <div class="layer_content">
            <table class="g_blue_table">
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
            <div class="g_left">
                <a href="../../customer/" class="btn-default btn-suc">1:1 문의하기</a>
            </div>
{{--            <div class="g_left" id="dvMessage_move"><span class="bold_txt"><a href="#">이전</a> | <a href="#">다음</a></span></div>--}}
            <div class="g_right">
                <a href="#" onclick="$.fnDelete();" class="btn-default btn-gray">삭제</a>
            </div>
        </div>
    </div>
    <!-- ▲ 메시지 레이어 //-->
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
