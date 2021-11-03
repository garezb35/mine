@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/buy/css/index_view.css?v=190220">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21100816"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript">
        function _init() {
            $('#btn_list').delay(1200).fadeIn(500);
        }
    </script>

@endsection

@section('content')
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        <div class="aside">
            <div class="title_green">알아두기</div>
            <div class="menu_know">
                <p>구매물품 쉽게 등록하기</p> <img src="http://img2.itemmania.com/new_images/buy/buy_left_know.gif" width="192" height="224" alt="삽니다 쉽게 등록하기">
                <p>구매물품 등록 시 알아둘 점</p>
                <ul class="g_list">
                    <li>등록자는 등록한 물품의 문제 발생 시 민/형사상의 모든 책임을 질 것에 동의하는 것으로 간주됩니다.</li>
                    <li>현재 연락처로 꼭 수정해주세요.
                        <br>연락처가 불분명 시 거래에 불이익을 받으실 수 있습니다.</li>
                    <li>[나만의 검색메뉴]를 이용하시면 간편하게 물품등록을 할 수 있습니다.</li>
                </ul>
            </div>
        </div>
        <div class="g_content">
            <div class="g_title_green"> 삽니다 <span>등록</span>
                <ul class="g_path">
                    <li>홈</li>
                    <li class="select">구매등록</li>
                </ul>
            </div>
            <div class="box6"> <span class="reg_icon"></span>
                <p class="complete_txt">물품이 정상적으로 등록되었습니다.</p> 현재 연락처로 꼭 수정해주세요!
                <br> 연락처가 불분명 시 거래에 불이익을 받을 수 있습니다. </div>
            <div class="g_subtitle">물품정보</div>
            <table class="g_green_table">
                <colgroup>
                    <col width="130">
                    <col>
                    <col width="130">
                    <col>
                </colgroup>
                <tr>
                    <th>카테고리</th>
                    <td colspan="3">AOS레전드 > 기타 > 기타</td>
                </tr>
                <tr>
                    <th>제목</th>
                    <td colspan="3"> 기타 삽니다. </td>
                </tr>
                <tr>
                    <th>거래번호</th>
                    <td>#2021101407759231</td>
                    <th>등록일시</th>
                    <td>2021-10-14 14:02:09</td>
                </tr>
                <tr>
                    <th>물품종류</th>
                    <td>기타</td>
                    <th>거래유형</th>
                    <td>일반구매</td>
                </tr>
                <tr>
                    <th>구매수량</th>
                    <td>-</td>
                    <th>구매금액</th>
                    <td>3,000원</td>
                </tr>
                <tr>
                    <th>
                        <br>신용등급별
                        <br>물품등록정보
                        <br>&nbsp;</th>
                    <td colspan="3"> 15시까지 해당 ID로 9개 / IP에서 19개까지 추가등록 가능합니다.
                        <br>(추가등록 가능한 횟수에는 재등록도 포함됩니다.) <a href="/myroom/coupon/add_reg.html" class="btn_green2 add_reg">물품추가 등록권 구매하기</a> </td>
                </tr>
            </table>
            <div id="btn_list" class="g_btn_wrap btn_list">
                <a href="/myroom/buy/buy_regist_view.html?id=2021101407759231"><img class="first" src="http://img4.itemmania.com/new_images/btn/btn_buy_veiw.gif" width="190" height="46" alt="등록 물품보기"></a>
                <a href="/buy/list_search.html?pinit=1&continue=YTozNzp7czo5OiJnYW1lX2NvZGUiO3M6NDoiMzQ5MiI7czoxMToic2VydmVyX2NvZGUiO3M6NToiMTM2NjciO3M6OToiZ2FtZV9uYW1lIjtzOjMwOiJBT1MlRUIlQTAlODglRUMlQTAlODQlRUIlOTMlOUMiO3M6MTE6InNlcnZlcl9uYW1lIjtzOjE4OiIlRUElQjglQjAlRUQlODMlODAiO3M6MTI6InNlYXJjaF9nb29kcyI7czozOiJldGMiO3M6MTE6InNlYXJjaF93b3JkIjtzOjA6IiI7czo0OiJ0eXBlIjtzOjM6ImJ1eSI7czoxMjoic2VhcmNoX29yZGVyIjtzOjE6IjIiO3M6MTQ6InNlYXJjaF9yZWZlcmVyIjtzOjE1OiJpbmRleF92aWV3Lmh0bWwiO3M6MTE6InRyYWRlX3N0YXRlIjtzOjE6IjEiO3M6ODoicmVnX3RpbWUiO3M6MToiMSI7czoxMToiY3JlZGl0X3R5cGUiO3M6MToiMSI7czoxMDoiZ29vZHNfdHlwZSI7czoxOiIxIjtzOjY6ImNvbXBlbiI7TjtzOjExOiJzZWxsX2NvbXBlbiI7TjtzOjc6ImRpc2NvbnQiO047czo3OiJvdmVybGFwIjtOO3M6OToiZXhjZWxsZW50IjtOO3M6NzoiYW1vdW50MSI7czoxOiIxIjtzOjc6ImFtb3VudDIiO3M6ODoiOTk5OTk5OTkiO3M6NzoiYW1vdW50MyI7czoxOiIxIjtzOjc6ImFtb3VudDQiO3M6ODoiOTk5OTk5OTkiO3M6MTI6InNlYXJjaF90eXBlMSI7TjtzOjEyOiJzZWFyY2hfdHlwZTIiO047czoxNToibW9uZXlfbGlzdF9yb3dzIjtOO3M6MTM6Imdlbl9saXN0X3Jvd3MiO047czoxNjoic3JjaF9pdGVtX2RlcHRoMSI7TjtzOjE2OiJzcmNoX2l0ZW1fZGVwdGgyIjtOO3M6MTY6InNyY2hfaXRlbV9kZXB0aDMiO047czoxNjoic3JjaF9pdGVtX2RlcHRoNCI7TjtzOjY6ImRpcmVjdCI7TjtzOjEyOiJhY2NvdW50X3R5cGUiO047czoxMzoicHVyY2hhc2VfdHlwZSI7TjtzOjE3OiJwYXltZW50X2V4aXN0ZW5jZSI7TjtzOjEyOiJtdWx0aV9hY2Nlc3MiO047czoxNToic3JjaF9jaGFyX2FsYXJtIjtOO3M6OToiYkxpbmVhZ2VNIjtiOjA7fQ=="><img class="first" src="http://img4.itemmania.com/new_images/btn/btn_buy_list.gif" width="190" height="46" alt="삽니다 물품리스트 보기"></a>
                <a href="/"><img src="http://img4.itemmania.com/new_images/btn/btn_main.gif" width="190" height="46" alt="메인으로"></a>
                <a href="/myroom/buy/buy_regist.html"><img src="http://img4.itemmania.com/new_images/btn/btn_myroom.gif" width="190" height="46" alt="마이룸으로 가기"></a>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
