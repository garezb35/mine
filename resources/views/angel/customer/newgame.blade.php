@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/customer/css/customer_common.css" />
    <link type="text/css" rel="stylesheet" href="/angel/customer/newgame/css/index.css" />
@endsection

@section('foot_attach')

    <script type='text/javascript'>
        var games_select2 = new Array();
        ajaxRequest({
            url: '/api/game_list',
            type: 'POST',
            data: {api_token: a_token, alias: 1},
            dataType:'json',
            success: function(res) {
                games_select2 = res;
            }
        })
        $("#new-game-btn").click(function(){
            if($("#radio1").prop('checked')){
                if($('input[name="game_name"]').val().trim() == '' ) {
                    alert('게임명을 입력해주세요');
                    $('input[name="game_name"]').focus();
                    return false;
                }
            }
            if($("#radio2").prop('checked')){
                if($("#game_text_combo").val().trim() == ''){
                    alert('게임을 선택해주세요');
                    return false;
                }
                if($('input[name="server_name"]').val().trim() == '' ) {
                    alert('서버명 입력해주세요');
                    $('input[name="server_name"]').focus();
                    return false;
                }
            }
            if($("#radio3").prop('checked')){
                if($('input[name="gs_subject"]').val().trim() == '' ) {
                    alert('제목을 입력해주세요');
                    $('input[name="gs_subject"]').focus();
                    return false;
                }
                if($('textarea[name="gs_content"]').val().trim() == '' ) {
                    alert('내용을 입력해주세요');
                    $('textarea[name="gs_content"]').focus();
                    return false;
                }
            }
            $.ajax({
                url: '/api/frm_game',
                dataType: 'json',
                type: 'post',
                data: $("#frm_game").serialize(),
                success: function (xml) {
                    if(xml.status == 1){
                        socket_client.emit('admin_notice',xml.data);
                        location.href="/customer/myqna/list"
                    }
                    else{
                        alert('서버오류')
                    }
                }
            });
        })

    </script>
    <script type="text/javascript" src="/angel/customer/newgame/js/index.js"></script>
@endsection

@section('content')
    <div @class('bg-white')>
        <div>
        </div>
        <div>
            <style>
                .aside .notice {
                    height: 24px;
                    margin-top: 20px;
                    font-weight: bold;
                    border-bottom: 1px solid #E1E1E1
                }

                .aside .notice img {
                    margin: 5px 3px 0 0
                }

                .aside .notice_list {
                    margin: 0 0 30px;
                    padding-top: 10px;
                    background: none;
                    border: 0
                }

                .aside .notice_list li {
                    margin-left: 10px;
                    margin-bottom: 3px;
                    color: #767676;
                    font-size: 12px
                }

                .aside .img_wrap {
                    box-sizing: border-box;
                    width: 214px;
                    margin-bottom: 10px;
                    padding: 10px 0;
                    text-align: center;
                    border: 1px solid #E1E1E1
                }
            </style>
            @include('angel.customer.aside', ['group'=>'newgame', 'part'=>''])
            <div class="pagecontainer">
                <form method="post" id="frm_game" action="">
                    @csrf
                    <input type="hidden" name="api_token" value="{{$me['api_token']}}">
                    <input type="hidden" name="a_code" value="A4" />
                    <input type="hidden" name="b_code" value="01" />
                    <input type="hidden" name="subject" value="신규게임/서버 추가요청입니다." />
                    <div class="gray_box">
                        <div class="highlight_contextual_nodemon">신규게임/서버 추가</div>
                        <table class="table-primary tb_list" id="list__server_table">
                            <colgroup>
                                <col width="104"/>
                            </colgroup>
                            <tr>
                                <th>분류</th>
                                <td>
                                    <label for="radio1">
                                        <input type="radio" id="radio1" class="g_radio first_radio" name="new_type" value="g" checked="checked" />신규게임 </label>
                                    <label for="radio2">
                                        <input type="radio" id="radio2" class="g_radio" name="new_type" value="s" />신규서버 </label>
                                    <label for="radio3">
                                        <input type="radio" id="radio3" class="g_radio" name="new_type" value="e" />기타 </label>
                                </td>
                            </tr>
                            <tr>
                                <th id="game_th">게임명</th>
                                <td id="game_td">
                                    <input type="text" class="f_control_txt_cus" name="game_name" placeholder="게임명"/> </td>
                            </tr>
                            <tr>
                                <th id="server_th">서버명</th>
                                <td id="server_td">
                                    <input type="text" class="f_control_txt_cus" name="server_name" style="background:#E0E0E0;" disabled="disabled" /> </td>
                            </tr>
                            <tr id="addr_tr">
                                <th>URL(주소)</th>
                                <td>
                                    <input type="text" class="f_control_txt_cus" name="game_url" placeholder="주소" />
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="btn-groups_angel">
                        <a type="submit" class="button-success" id="new-game-btn">확인</a>
                    </div>
                </form>
            </div>
            <div class="empty-high"></div>
        </div>
    </div>
@endsection
