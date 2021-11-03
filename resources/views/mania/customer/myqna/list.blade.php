@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/customer/css/menu.css" />
    <link type="text/css" rel="stylesheet" href="/mania/customer/css/customer_common.css" />
    <link type="text/css" rel="stylesheet" href="/mania/customer/myqna/css/list.css" />
    <link type="text/css" rel="stylesheet" href="/mania/_css/_table_list.css" />
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/customer/myqna/js/list.js"></script>
    <script type='text/javascript'>
        var gsVersion = '2110141801';
        var _LOGINCHECK = '1';
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
        @include('mania.customer.aside', ['group'=>'myqna', 'part'=>''])
        <div class="g_content">
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue"> 나의 질문과 답변
                <ul class="g_path">
                    <li>홈</li>
                    <li>고객센터</li>
                    <li class="select">나의 질문과 답변</li>
                </ul>
            </div>
            <!-- ▲ 타이틀 //-->
            <div class="myqna_top customer_top">
                <ul class="g_left mt_30">
                    <li class="bg_icon"><span class="big_title">이장훈</span>님 안녕하세요.</li>
                    <li>고객님이 문의하신 내역과 답변을 확인하실 수 있습니다.</li>
                </ul>
            </div>
            <form name="signForm" id="signForm" method="post">
                <table class="g_gray_tb tb_list">
                    <colgroup>
                        <col width="30" />
                        <col width="35" />
                        <col width="120" />
                        <col width="120" />
                        <col />
                        <col width="95" />
                        <col width="125" /> </colgroup>
                    <tr>
                        <th class="first_th">
                            <input type="checkbox" name="cTotal" class="g_checkbox" onclick="fnCheck();">
                        </th>
                        <th>상태</th>
                        <th>분야</th>
                        <th>거래번호</th>
                        <th>제목</th>
                        <th>처리상황</th>
                        <th>등록일시</th>
                    </tr>
                    <tr>
                        <td class="first_td">
                            <input type="checkbox" name="pSeq[]" value="13546539" class="g_checkbox" /> </td>
                        <td><img src="http://img4.itemmania.com/images/icon/ico_message.gif" width="14" height="11" alt="확인" /></td>
                        <td>종료요청</td>
                        <td>2021020815297829</td>
                        <td class="left"><a href="/customer/myqna/view.html?seq=13546539&original_type=1">거래 종료 요청</a></td>
                        <td> 답변 완료 </td>
                        <td>2021-02-09 00:01</td>
                    </tr>
                    <tr>
                        <td class="first_td">
                            <input type="checkbox" name="blankCheck" class="g_checkbox" disabled="disabled" /> </td>
                        <td><img src="http://img3.itemmania.com/images/icon/ico_message_on.gif" width="14" height="11" alt="미확인" /></td>
                        <td>종료요청</td>
                        <td>2021013113448891</td>
                        <td class="left"><a href="/customer/myqna/view.html?seq=13531925&original_type=1">거래 종료 요청</a></td>
                        <td> 답변 완료 </td>
                        <td>2021-01-31 23:15</td>
                    </tr>
                    <tr>
                        <td class="first_td">
                            <input type="checkbox" name="blankCheck" class="g_checkbox" disabled="disabled" /> </td>
                        <td><img src="http://img3.itemmania.com/images/icon/ico_message_on.gif" width="14" height="11" alt="미확인" /></td>
                        <td>종료요청</td>
                        <td>2021013111553078</td>
                        <td class="left"><a href="/customer/myqna/view.html?seq=13531645&original_type=1">거래 종료 요청</a></td>
                        <td> 답변 완료 </td>
                        <td>2021-01-31 20:04</td>
                    </tr>
                </table>
            </form>
            <div class="tb_bt_txt"> <img src="http://img4.itemmania.com/images/btn/btn_del1.gif" width="42" height="20" alt="삭제" class="g_button" onclick="$('signForm').check();" /> <span class="f_org1">- 2020년 7월 1일 이후 메시지만 보관되오니 이점 양지해주시기 바랍니다.</span> </div>
            <!-- ▼ 페이징 //-->
            <div class="dvPaging">
                <ul class="g_paging">
                    <li class='start'><strong class="g_blue">1</strong></li>
                </ul>
            </div>
            <!-- ▲ 페이징 //-->
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection

