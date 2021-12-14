@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/customer/css/customer_common.css" />
    <link type="text/css" rel="stylesheet" href="/angel/customer/newgame/css/index.css" />
@endsection

@section('foot_attach')
{{--    <script type="text/javascript" src="/angel/_js/_game_server_list.js"></script>--}}
    <script type="text/javascript" src="/angel/customer/newgame/js/index.js"></script>
    <script type='text/javascript'>


    </script>
@endsection

@section('content')
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
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
        <div class="g_content">
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue no-border"> 신규게임/서버 추가 </div>
            <!-- ▲ 타이틀 //-->
            <div style="height: 80px;"></div>
            <!-- ▼ 신규게임/서버 추가 //-->
            <form method="post" id="frm_game" action="">
                @csrf
                <input type="hidden" name="a_code" value="A4" />
                <input type="hidden" name="b_code" value="01" />
                <input type="hidden" name="subject" value="신규게임/서버 추가요청입니다." />
                <div class="gray_box">
                    <div class="g_subtitle">신규게임/서버 추가</div>
                    <table class="g_gray_tb g_sky_table">
                        <colgroup>
                            <col width="150" />
                            <col width="300" /> </colgroup>
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
                                <input type="text" class="g_text" name="game_name" value="게임명을 입력해 주세요." /> </td>
                        </tr>
                        <tr>
                            <th id="server_th">서버명</th>
                            <td id="server_td">
                                <input type="text" class="g_text" name="server_name" style="background:#E0E0E0;" disabled="disabled" /> </td>
                        </tr>
                        <tr id="addr_tr">
                            <th>URL(주소)</th>
                            <td>http://
                                <input type="text" class="g_text" name="game_url" value="주소를 입력해 주세요." />
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="g_btn">
                    <button type="submit" class="btn-color-img btn-blue-img">확인</button>
                </div>
            </form>
            <!-- ▲ 신규게임/서버 추가 //-->
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
