@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/customer/css/customer_common.css?210901" />
    <link type="text/css" rel="stylesheet" href="/mania/customer/myqna/css/view.css?210503" />
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/customer/myqna/js/view.js?190220"></script>
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
        <div class="aside">
            <div class="nav_subject"><a href="/customer/" class="customer">고객감동센터</a></div>
            <div class="nav">
                <div class="nav_title "><a href="/customer/faq/">FAQ</a></div>
                <div class="nav_title "><a href="javascript:_window.open('chat','/chat/agree.php', 580, 470);">실시간 채팅상담</a></div>
                <div class="nav_title "><a href="/customer/report/">1:1 상담하기</a></div>
                <ul class='nav_sub g_list'>
                    <li class=""><a href="/customer/report/trade_prc.html">거래취소 / 종료</a></li>
                    <li class=""><a href="/customer/report/etc.html">이용관련</a></li>
                    <li class=""><a href="/customer/report/trade_acd.html">거래사고</a></li>
                </ul>
                <div class="nav_title on_active"><a href="/customer/myqna/list.html">나의 질문과 답변</a></div>
                <div class="nav_title "><a href="/customer/newgame/index.html">신규게임/서버 추가</a></div>
                <div class="nav_title "><a href="/customer/safety/index.html">안전거래</a></div>
                <div class="nav_title "><a href="/customer/compensate/index.html">보상제도</a></div>
                <div class="nav_title "><a href="/customer/compensate_buy/index.html">200% 구매보상</a></div>
                <div class="nav_title "><a href="/customer/board/list.html">자료실</a></div>
            </div>
        </div>
        <div class="g_content">
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue"> 1:1 상담하기
                <ul class="g_path">
                    <li>홈</li>
                    <li>고객센터</li>
                    <li class="select">1:1 상담하기</li>
                </ul>
            </div>
            <!-- ▲ 타이틀 //-->
            <div class="myqna_top customer_top">
                <ul class="g_left">
                    <li class="bg_icon"><span class="big_title">이장훈</span>님 안녕하세요.</li>
                    <li>문의하실 내용을 선택해주세요. 성심 성의껏 답변해 드리도록 하겠습니다.</li>
                </ul>
            </div>
            <!-- ▼ 나의 1:1 상담내역 //-->
            <div class="s_subtitle">나의 1:1 상담내역</div>
            <table class="g_gray_tb">
                <colgroup>
                    <col width="120" />
                    <col width="258" />
                    <col width="120" />
                    <col /> </colgroup>
                <tr>
                    <th>상담분류</th>
                    <td>종료요청</td>
                    <th>문의일자</th>
                    <td>2021-02-09 00:01:30</td>
                </tr>
                <tr>
                    <th>제목</th>
                    <td colspan="3">거래 종료 요청</td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td colspan="3"> 거래&nbsp;종료&nbsp;요청 </td>
                </tr>
            </table>
            <!-- ▲ 나의 1:1 상담내역 //-->
            <!-- ▼ 문의한 내용 답변보기 //-->
            <div class="s_subtitle">문의한 내용 답변보기</div>
            <table class="g_gray_tb">
                <colgroup>
                    <col width="120" />
                    <col width="258" />
                    <col width="120" />
                    <col width="257" /> </colgroup>
                <tr>
                    <th>처리상태</th>
                    <td>처리완료</td>
                    <th>답변일자</th>
                    <td>2021-02-09 00:02:56</td>
                </tr>
                <tr>
                    <th>답변내용</th>
                    <td colspan="3"> 이장훈 고객님
                        <br>
                        <br>안전한 온라인 거래 문화를 지향하는 아이템매니아 웹 매니저 이대화 입니다.
                        <br>
                        <br>고객님께서 보내주신 소중한 문의 잘 받아보았습니다.
                        <br>
                        <br>문의하신 거래는 정상적으로 종료 처리 완료 되었습니다.
                        <br> 홈페이지 [마이룸] ＞ [종료내역] ＞ [판/구매 종료내역] 에서 확인 바랍니다.
                        <br>
                        <br> 문의 감사드리며 항상 고객님을 위해 최선을 다하겠습니다.
                        <br>
                        <br>항상 고객님의 입장에서 생각하고, 더욱 더 열심히 하는 아이템매니아가 되겠습니다.
                        <br>이용해 주셔서 감사합니다.
                        <br>
                        <br> </td>
                </tr>
                <tr>
                    <td class="first_td" colspan="4">
                        <form name="statistics" id="statistics" method="post" action="statistics.php">
                            <div class="g_left">
                                <input type="hidden" name="original_type" value="1" />
                                <input type="hidden" name="seq" value="13546539" />
                                <input type="radio" class="g_radio first_radio" name="reply_point" value="100" checked="checked" /><img src="http://img3.itemmania.com/images/myroom/ico_5star.gif" width="79" height="11" alt="" />
                                <input type="radio" class="g_radio" name="reply_point" value="80" /><img src="http://img4.itemmania.com/images/myroom/ico_4star.gif" width="79" height="11" alt="" />
                                <input type="radio" class="g_radio" name="reply_point" value="60" /><img src="http://img2.itemmania.com/images/myroom/ico_3star.gif" width="79" height="11" alt="" />
                                <input type="radio" class="g_radio" name="reply_point" value="40" /><img src="http://img3.itemmania.com/images/myroom/ico_2star.gif" width="79" height="11" alt="" />
                                <input type="radio" class="g_radio" name="reply_point" value="20" /><img src="http://img4.itemmania.com/images/myroom/ico_1star.gif" width="79" height="11" alt="" /> </div>
                            <input type="image" class="g_right" src="http://img2.itemmania.com/images/btn/btn_safi.gif" class="g_image" width="80" height="22" alt="만족도체크" /> </form>
                    </td>
                </tr>
            </table>
            <!-- ▲ 문의한 내용 답변보기 //-->
            <!-- ▼ 삭제 / 목록 버튼 //-->
            <ul class="del_list_btn">
                <li>
                    <form name="signForm" id="signForm" method="post" action="customer_delete.php">
                        <input type="hidden" name="pSeq[]" value="13546539" />
                        <input type="image" src="http://img3.itemmania.com/images/btn/btn_del1.gif" class="g_image" width="42" height="20" alt="삭제" /> </form>
                </li>
                <li>
                    <a href="./list.html?page="><img src="http://img4.itemmania.com/images/btn/btn_list1.gif" width="32" height="20" alt="목록" /></a>
                </li>
            </ul>
            <div class="g_finish"></div>
            <!-- ▲ 삭제 / 목록 버튼 //-->
            <!-- ▼ 재문의하기 //-->
            <div class="g_big_box1">
                <div class="g_left"> <img src="http://img2.itemmania.com/images/icon/ico_red.gif" width="2" height="8" alt="" /> 답변이 부족하셨다면 재문의 하기를 통해 문의 하실 수 있습니다. </div>
                <a href="/customer/trade/before_sell_list.html?m_type=sell&t_type=bs&reflag=p&retry=2021020815297829&a_code=A1&b_code=01&c_code=02"><img class="g_right" src="http://img3.itemmania.com/images/btn/btn_reask.gif" width="80" height="20" alt="재문의하기" /></a>
            </div>
            <!-- ▲ 재문의하기 //-->
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->

@endsection
