<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="/angel/photoswipe/css/default-skin/default-skin.css">
        <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css">
        <link type="text/css" rel="stylesheet" href="/angel/global_h/css/_head_popup.css">
        <link type="text/css" rel="stylesheet" href="/angel/carsouel_plugin/css/carsouel_plugin.css">
    </head>
    <body>
    <style>
        #msgBox::-webkit-scrollbar-track {
            background: #cccccc;
        }
        #msgBox::-webkit-scrollbar-thumb {
            background-color: #7a7575;
            outline: 1px solid slategrey;
            border-radius: 5px;
        }
        #msgBox::-webkit-scrollbar {
            width: 5PX;
        }
        .box-chatting{
            background: #fff;
            border: 1px solid #9d9d9d;
        }
        .box-chatting .nav-link{
            display: block;
            padding: 0rem  0rem
        }
        .box-chatting .nav-item {
            width: 33.3%;
            text-align: center;
            /*border-right: 1px solid #cecece;*/
        }
        .box-chatting .nav-tabs .nav-link {
            border-radius: 0px;
            background: #cccccc;
            padding-top: 5px;
            padding-bottom: 5px;
            font-size: 15px;
            color: #000;
            text-align: center;
        }
        .box-chatting .nav-item.show .nav-link, .box-chatting .nav-link.active{
            /*+*/
            /*border-color: #ddd #ddd #ededed;*/
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
            font-weight: 700;
            background: #5371bc;
            color: #fff;
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
            color: #000;
            padding: 0 5px;
            outline: none !important;
            background: #fff;
            border-top: 1px solid #919191;
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
            background: #e0e0e0;
        }
        .box-chatting .btn-etc .cnt {
            color: #000;
            margin-left: 10px;
        }
        .sp-bl_pp {
            width: 25px;
            height: 25px;
            background: url(/angel/img/icons/user_cnt.png);
            display: inline-block;
            background-repeat: no-repeat;
            margin-top: 6px;
        }
        .sp-btn_chat1,.sp-btn_chat4,.sp-btn_chat5  {
            display: block;
            font-size: 15px;
            color: #000;
            width: 23px;
            height: 31px;
            line-height: 31px;
            text-align: center;
        }
        .sp-btn_chat1 i,.sp-btn_chat4 i,.sp-btn_chat5 i{
            line-height: 32px;
        }
        .sp-btn_chat2 {
            display: block;
            width: 23px;
            height: 31px;
            color: #000;
            text-align: center;
            line-height: 31px;
            font-weight: bold;
        }
        .sp-btn_chat3 {
            display: block;
            width: 23px;
            height: 31px;
            color: #000;
            font-size: 10px;
            text-align: center;
            line-height: 31px;
        }
        .box-chatting .btn-etc ul.ul-1 li {
            float: left;
            border-left: 1px solid #5f8cc7;
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
            color: #000;
            margin: 5px;
            padding: 10px;
            font-size: 14px;
        }
        #ruleBox .borderBox .tit {
            color: #C11A20;
            font-weight: bold;
        }
        #ruleBox .borderBox ul {
            margin-top: 5px;
            margin-left: 5px;
            font-size: 13px;
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
            color: #727272;
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
                    <span id="connectUserCnt" rel=""></span>???
                    <span id="loginUserCnt"></span>
                </span>
                <ul class="ul-1">
                    <li>
                        <a href="#" onclick="chatManager('popupChat');return false;" title="??????" class="sp-btn_chat1">
                            <i class="fa fa-external-link" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li >
                        <a href="#" onclick="fontZoom(1);return false;" title="????????????" class="sp-btn_chat2">
                            ???
                        </a>
                    </li>
                    <li >
                        <a href="#" onclick="fontZoom(-1);return false;" title="????????????" class="sp-btn_chat3">
                            ???
                        </a>
                    </li>
                    <li >
                        <a href="#" onclick="chatManager('clearChat');return false;" title="????????? ?????????" class="sp-btn_chat4">
                            <i class="fa fa-eraser"></i>
                        </a>
                    </li>
                    <li >
                        <a href="#" onclick="chatManager('refresh');return false;" title="????????????" class="sp-btn_chat5">
                            <i class="fa fa-refresh" aria-hidden="true"></i>

                        </a>
                    </li>
{{--                    <li>--}}
{{--                        <a href="#" onclick="return false;" id="soundBtn" title="????????????" class="sp-btn_chat_sound on"></a>--}}
{{--                    </li>--}}
                </ul>
            </div>
            <div class="table-type-1">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="chatroomListBox-tab" data-toggle="tab" data-bs-toggle="tab" href="#chatTap" role="tab" aria-controls="home" aria-selected="true">??????</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="connect-tab" data-toggle="tab" data-bs-toggle="tab" href="#connectTap" role="tab" aria-controls="contact" aria-selected="false">?????????</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rule-tab" data-toggle="tab" data-bs-toggle="tab" href="#ruleTap" role="tab" aria-controls="contact" aria-selected="false">????????????</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="chatTap" role="tabpanel" aria-labelledby="home-tab">
                    <div id="chatListBox" style="position:relative;">
                        <ul class="list-chatting" id="msgBox">

                        </ul>
                        <p class="input-chatting">
                            <input type="text" name="msg" id="msg" class="input-1" autocomplete="off" placeholder="???????????? ?????????????????? (?????? 40???)">
                            <input type="hidden" class="input-2 sp-btn_enter" id="sendBtn">
                            <a href="#" class="scrollBottom" id="scrollBottom" style="display: none;"></a>
                        </p>
                    </div>
                </div>
                <div class="tab-pane fade" id="connectTap" role="tabpanel" aria-labelledby="profile-tab">
                    <div id="connectListBox" style="height: 450px">
                        <ul class="list-connect" id="connectList">

                        </ul>

                    </div>
                </div>


                <div class="tab-pane fade" id="ruleTap" role="tabpanel" aria-labelledby="contact-tab">
                    <div id="ruleBox" style="height: 450px; ">
                        <div class="borderBox">
                            <div class="tit">????????? ??????</div>
                            <ul>
                                <li>- ??? ????????? ?????? ?????? ?????? ??? ?????? ??????</li>
                                <li>- ?????? ??????, ?????? ?????? ??????</li>
                                <li>- ????????? ??????</li>
                                <li>- ????????? ?????? ??? ?????? ??????</li>
                                <li>- ???????????? ???????????? ??????????????? ???????????? ??????</li>
                            </ul>
                        </div>
                        <div class="borderBox">
                            <div class="tit">?????? ?????? ??????</div>
                            <ul>
                                <li>- ???????????? ?????? ??? ??????</li>
                                <li>- ??? ????????? ?????? ??? ??????</li>
                                <li>- ?????? ???????????? ??????</li>
                                <li>- ????????? ??? ????????? ??????</li>
                                <li>- ???????????? ????????? ??????</li>
                                <li>- ?????? ??? ?????? ?????? ??????</li>
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
