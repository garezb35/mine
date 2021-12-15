<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="/angel/photoswipe/css/default-skin/default-skin.css">
        <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css">
        <link type="text/css" rel="stylesheet" href="/angel/global_h/css/_head_popup.css">
        <link type="text/css" rel="stylesheet" href="/angel/_banner/css/banner_module.css">
    </head>
    <body>
    <style>
        .box-chatting .nav-link{
            display: block;
            padding: 0rem  0rem
        }
        .box-chatting .nav-item {
            width: 33%;
            text-align: center;
            border-right: 1px solid #cecece;
        }
        .box-chatting .nav-tabs .nav-link {
            border-radius: 0px;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #1592fd;
            background: #fff;
            padding-top: 2px;
            padding-bottom: 2px;
            font-size: 15px;
            color: #919394;
            text-align: center;
        }
        .box-chatting .nav-item.show .nav-link, .box-chatting .nav-link.active{
            color: #495057;
            border-color: #ddd #ddd #fff;
        }
        .box-chatting .nav {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }
        .box-chatting .nav-tabs .nav-item.show .nav-link, .box-chatting .nav-tabs .nav-link.active {
            border-top: #1592fd 1px solid;
            border-right: #1592fd 1px solid;
            border-left: #1592fd 1px solid !important;
            font-weight: 700;
            background: white;
        }
        #msgBox .msg-guide {
            background-color: #1592fd;
            border: 1px solid #1592fd;
            min-height: 22px;
            line-height: 22px;
            color: #fff;
            padding: 0 5px;
            margin: 3px 0;
        }
        #msgBox {
            font-size: 12px;
            word-wrap: break-word;
            overflow-y: scroll;
        }
        .box-chatting .list-chatting {
            overflow-x: hidden;
            overflow-y: scroll;
            padding: 0 5px 0 5px;
        }
        .box-chatting .input-chatting {
            position: relative;
            background: #e2e2e2;
            margin-bottom: 0px;
        }
        .box-chatting .input-chatting .input-1 {
            width: 100%;
            height: 40px;
            line-height: 40px;
            border: none;
            color: #949494;
            padding: 0 5px;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            outline: none !important;
            border-top: 1px solid #e9ecef;
        }
        .box-chatting .input-chatting .input-2 {
            position: absolute;
            top: 2px;
            right: 2px;
            *top: 3px;
            border: none;
        }
        .sp-btn_enter {
            width: 22px;
            height: 22px;
            background: url(/assets/images/powerball/sp_chat.png) -608px -215px;
        }

        .box-chatting .btn-etc {
            position: relative;
            z-index: 10;
            background: #efefef;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
        }
        .box-chatting .btn-etc .cnt {
            color: #4c4c4c;
        }
        .sp-bl_pp {
            width: 25px;
            height: 25px;
            background: url(/assets/images/powerball/sp_chat.png) -608px -139px;
            display: inline-block;
        }
        .sp-btn_chat1 {
            width: 28px;
            height: 25px;
            background: url(/assets/images/powerball/sp_chat.png) -154px -490px;
            display: block;
        }
        .sp-btn_chat2 {
            width: 28px;
            height: 25px;
            background: url(/assets/images/powerball/sp_chat.png) -106px -490px;
            display: block;
        }
        .sp-btn_chat3 {
            width: 28px;
            height: 25px;
            background: url(/assets/images/powerball/sp_chat.png) -550px -443px;
            display: block;
        }
        .sp-btn_chat4 {
            width: 28px;
            height: 25px;
            background: url(/assets/images/powerball/sp_chat.png) -10px -490px;
            display: block;
        }
        .sp-btn_chat5 {
            width: 28px;
            height: 25px;
            background: url(/assets/images/powerball/sp_chat.png) -463px -430px;
            display: block;
        }
        .box-chatting .btn-etc ul.ul-1 li {
            float: left;
            border-left: 1px solid #cecece;
        }
        .box-chatting .btn-etc ul.ul-1 {
            position: absolute;
            top: 0;
            right: 0;
        }
        .box-chatting .btn-etc .cnt * {
            vertical-align: middle;
        }
        .box-chatting .btn-etc .cnt span {
            font-weight: bold;
        }
        .fade {
            opacity: 0;
            transition: opacity .15s linear;
        }
        .tab-content>.tab-pane {
            display: none;
        }
        .tab-content>.active {
            display: block;
        }
        .fade.show {
            opacity: 1;
        }
        #msgBox .msg-system {
            background-color: #cb500e;
            border: 1px solid #9d3e0b;
            min-height: 22px;
            line-height: 22px;
            color: #fff;
            padding: 0 5px;
            margin: 3px 0;
        }
        #ruleBox .borderBox {
            background-color: #F5F5F5;
            margin: 5px;
            padding: 10px;
        }
        #ruleBox .borderBox .tit {
            color: #C11A20;
            font-weight: bold;
        }
        #ruleBox .borderBox ul {
            margin-top: 5px;
            margin-left: 5px;
            font-size: 11px;
            line-height: 18px;
        }
        .box-chatting .list-connect li {
            color: #5e5e5e;
            line-height: 24px;
            border-bottom: 1px dotted #CECECE;
            font-weight: bold;
            padding: 5px;
        }
        .uname {
            color: #1592fd;
        }
    </style>
        <script>
            var lastMsgTime = new Date().getTime();
            var msgStopTime = 10;
            var msgTermArr = new Array();
            var msgTermIdx = 0;
            var is_repeatChat  = false;
            var filterWordArr = new Array();
            var is_admin = false;
            var is_freeze = 'off';
            var blackListArr = new Array();
            var loginYN = 'N';
            var server_domain = '210.112.174.178';
            var userIdKey = '';
            @if(Auth::check())
                loginYN = 'Y';
            userIdKey = '{{Auth::user()->userIdKey}}';
            @endif
        </script>

        <div class="box-chatting">
            <div class="btn-etc">
                <span class="cnt">
                    <div class="sp-bl_pp"></div>
                    <span id="connectUserCnt" rel=""></span>명
                    <span id="loginUserCnt"></span>
                </span>
                <ul class="ul-1">
                    <li>
                        <a href="#" onclick="chatManager('popupChat');return false;" title="새창" class="sp-btn_chat1"></a>
                    </li>
                    <li style="background-color: rgb(243, 243, 243);">
                        <a href="#" onclick="fontZoom(1);return false;" title="글씨크게" class="sp-btn_chat2"></a>
                    </li>
                    <li style="background-color: rgb(243, 243, 243);">
                        <a href="#" onclick="fontZoom(-1);return false;" title="글씨작게" class="sp-btn_chat3"></a>
                    </li>
                    <li style="background-color: rgb(243, 243, 243);">
                        <a href="#" onclick="chatManager('clearChat');return false;" title="채팅창 지우기" class="sp-btn_chat4"></a>
                    </li>
                    <li style="background-color: rgb(243, 243, 243);">
                        <a href="#" onclick="chatManager('refresh');return false;" title="새로고침" class="sp-btn_chat5"></a>
                    </li>
                    <li>
                        <a href="#" onclick="return false;" id="soundBtn" title="소리끄기" class="sp-btn_chat_sound on"></a>
                    </li>
                </ul>
            </div>
            <div class="table-type-1">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="chatroomListBox-tab" data-toggle="tab" data-bs-toggle="tab" href="#chatTap" role="tab" aria-controls="home" aria-selected="true">채팅</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="connect-tab" data-toggle="tab" data-bs-toggle="tab" href="#connectTap" role="tab" aria-controls="contact" aria-selected="false">접속자</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rule-tab" data-toggle="tab" data-bs-toggle="tab" href="#ruleTap" role="tab" aria-controls="contact" aria-selected="false">채팅규정</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="chatTap" role="tabpanel" aria-labelledby="home-tab">
                    <div id="chatListBox" style="position:relative;">
                        <ul class="list-chatting" id="msgBox">

                        </ul>
                        <p class="input-chatting">
                            <input type="text" name="msg" id="msg" class="input-1" autocomplete="off" placeholder="메세지를 입력해주세요 (최대 40자)">
                            <input type="hidden" class="input-2 sp-btn_enter" id="sendBtn">
                            <a href="#" class="scrollBottom" id="scrollBottom" style="display: none;"></a>
                        </p>
                    </div>
                </div>
                <div class="tab-pane fade" id="connectTap" role="tabpanel" aria-labelledby="profile-tab">
                    <div id="connectListBox" style="height: 340px">
                        <ul class="list-connect" id="connectList">

                        </ul>

                    </div>
                </div>


                <div class="tab-pane fade" id="ruleTap" role="tabpanel" aria-labelledby="contact-tab">
                    <div id="ruleBox" style="height: 335px; ">
                        <div class="borderBox">
                            <div class="tit">벙어리 사유</div>
                            <ul>
                                <li>- 한 화면에 두번 이상 같은 글 반복 작성</li>
                                <li>- 상대 비방, 반말 또는 욕설</li>
                                <li>- 비매너 채팅</li>
                                <li>- 회원간 싸움 및 분란 조장</li>
                                <li>- 결과 거짓 중계</li>
                                <li>- 운영진의 판단하에 운영정책에 위배되는 행위</li>
                            </ul>
                        </div>
                        <div class="borderBox">
                            <div class="tit">접속 차단 사유</div>
                            <ul>
                                <li>- 개인정보 발언 및 공유</li>
                                <li>- 타 사이트 홍보 및 발언</li>
                                <li>- 불법 프로그램 홍보</li>
                                <li>- 운영진 및 사이트 비방</li>
                                <li>- 지속적인 비매너 채팅</li>
                                <li>- 부모 및 성적 관련 욕설</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </body>
    <script type="text/javascript" src="/angel/_js/jquery.js"></script>
    <script type="text/javascript" src="/angel/_js/webpack.js"></script>
    <script type="text/javascript" src="/angel/_js/angelic-global.js"></script>
    <script type="text/javascript" src="/angel/socket/socket.io.js"></script>
    <script type="text/javascript" src="/angel/js/chat.js"></script>
</html>
<script>
    function number_format(user_input){
        var filtered_number = user_input.replace(/[^0-9]/gi, '');
        var length = filtered_number.length;
        var breakpoint = 1;
        var formated_number = '';

        for(i = 1; i <= length; i++){
            if(breakpoint > 3){
                breakpoint = 1;
                formated_number = ',' + formated_number;
            }
            var next_letter = i + 1;
            formated_number = filtered_number.substring(length - i, length - (i - 1)) + formated_number;

            breakpoint++;
        }

        return formated_number;
    }
    $(".nav-link").click(function(event ){
        event.preventDefault();
        $(".tab-pane").removeClass('show');
        $(".tab-pane").removeClass('active');
        $($(this).attr("href")).addClass("show");
        $($(this).attr("href")).addClass("active");
        $(".nav-link ").removeClass("active");
        $(this).addClass("active");
    })


</script>
