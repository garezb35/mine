var socket;
window.addEventListener('load',function(){

    this.userInfo = {
        'token':document.querySelector('#CHAT_TOKEN').value,
        'whoAmI':document.querySelector('#CHAT_USER').value
    };
    this.chatWrapper = document.querySelector('#chat_wrapper');
    this.contentWrapper = document.getElementById('chat_content');
    this.wrapper = document.querySelector('#chat_list_wrapper');
    this.sender = document.querySelector('#send_btn');
    this.txt = document.querySelector('#chat');
    this.wrapper.innerHTML = "";
    this.msgBox = document.querySelector('#msg_box')
    this.firstFlag = document.querySelector('#CHAT_FIRST').value;
    this.filterData = document.querySelector('#CHAT_FILTER').value;
    this.pagination = 0;
    init();
});

function init(){

    socket = io.connect('http://'+server_domain+':7443', {
        path: '/socket.io',
        reconnectionAttempts:1,
        reconnectionDelay:500,
        reconnectionDelayMax:500,
        transports: ['websocket'],
        query: {
            token:this.userInfo.token
        }
    });

    socket.on('roomJoin', function(data) {
        // 채팅 입력창 활성화
        // 시스템 메시지 data.msg 'xxx님이 입장했습니다.'
        infoChat(data)
    });

    socket.on('roomExit', function(data) {
        // 채팅 입력창 비활성화
        // 시스템 메시지 data.msg 'xxx님이 퇴장하셨습니다.'
        infoChat(data)
    });

    socket.on('health', function(data) {
        if(data.use == true) {
            // 서버 연결 성공
        } else {
            // 서버 연결 실패
            // 채팅영역 비활성화
            handleError('connect_failed')
        }
    });

    socket.on('listenChat', function(data) {
        // data.msg 상대방이 보낸 메시지 출력
        // cryptoMsg(data.msg,'DEC', '', function(msg){
        //     if(msg == '')
        //     {
        //         alert('메시지 수신에 실패했습니다.');
        //         return;
        //     }
        //     data.msg = msg;
        //     appendChat(data);
        // });
        // data.msg = msg;
        appendChat(data);
    })

    socket.on('connect',function(){
        if(socket.connected == true) {
            // 채팅영역 활성화
            setTimeout(function(){
                this.chatWrapper.style.display = 'block';
                this.msgBox.style.display = 'none'
            },1);

        }
        if(socket.disconnected == true) {
            // 채팅영역 비활성화
            handleError('connect_failed')
        }
        socket.emit('login',this.userInfo);
    });

    socket.on('connect_error',function(e){
        //socket.close();    // 비정상 서버 다운 소켓 연결 강제종료 undefine error 확인 후 주석
        //handleError('connect_failed')
    });

    socket.on('connect_failed',function(e){
        handleError('connect_failed')
    });

    socket.on('reconnect_failed',function(e){
        handleError('connect_failed')
    });

    this.sender.addEventListener('click',function(){
        sendChat();
    });

    this.txt.addEventListener('keyup',function(e){
        this.style.height = resizeCalc();
    });

    this.txt.addEventListener('keydown',function(e){
        if(e.keyCode == 13)
        {
            if(!e.shiftKey){
                e.preventDefault();
                sendChat()
            }
        }
    });

    getHistory(this.userInfo.token);

    setTimeout(function(){
        scrollBottom();
    },100);

}

function sendChat(){
    var sendFlag = false;
    var val =  this.txt.value
    var checkNull = val.split('\n');

    if(!this.socket.connected)
    {
        handleError('not_connected')
        return;
    }

    if(val == '')
    {
        return;
    }

    checkNull.forEach(function(t){
        if(t !== '')
        {
            sendFlag = true;
        }
    });

    if(sendFlag)
    {
        if(this.firstFlag){
            // firstSend(this.userInfo.token)
            this.firstFlag = false;
        }

        var data = {
            'token':this.userInfo.token,
            'whoAmI':this.userInfo.whoAmI,
            'msg':val,
            'chat_de':'',

        };

        var tradeData = {};

        cryptoMsg(data,'ENC', this.filterData, function(msg, time, filter){
            if(msg == '' && msg ==  undefined)
            {
                alert('메시지 전송에 실패했습니다.');
                return;
            }

            data.chat_de = time;
            socket.emit('chat',data);

            if(filter == true) {
                location.reload();
            }

            appendChat(data);
        });

        this.txt.value = "";
        this.txt.style.height = '50px';
        this.txt.focus();

    }

}

//채팅 뿌리기
function appendChat(data){

    this.wrapper.insertAdjacentHTML('beforeend',makeChat(data));

    scrollBottom();
}

//채팅방 내역 뿌리기
function historyAppend(data){
    this.wrapper.insertAdjacentHTML('afterbegin',makeChat(data));
}

//채팅 내용 만들기
function makeChat(data){
    var reg_de = dateFormatter(data.chat_de);
    var hours = reg_de.getHours().toString();
    var minutes = reg_de.getMinutes().toString();
    if(minutes < 10)
    {
        minutes = '0'+minutes
    }
    var time = hours+':'+minutes;

    if(data.msg == null)
    {
        return;
    }

    var spl = data.msg.split('\n');
    var text = "";
    spl.forEach(function(t){
        if(t !== '')
        {
            text+='<span>'+t+'</span>';
        }
        text+='<br/>'
    });

    var checkAnother = this.userInfo.whoAmI == data.whoAmI? '<div class="chat_info me">':'<div class="chat_info another">';
    var statement = '';
    switch (data.whoAmI) {
        case "buyer":
            statement+='<li class=\"chat_list clear_fix\">';
            statement+= checkAnother;
            statement+= '<div class="user_identity_image list_content">';
            statement+= '<img src=\'/mania/img/level/'+data.image+'\' width=\'20\'  alt=\'구매자\'>';
            statement+= '</div>';
            statement+= '<div class="list_content">';
            statement+= '<p class="identity">구매자</p>';
            statement+= '<div class="chat_ballon buyer">'+text+'</div>';
            statement+= '<p class="chat_de">'+time+'</p>';
            statement+= '</div></div></li>';
            break;
        case "seller":
            statement+='<li class=\"chat_list clear_fix\">';
            statement+= checkAnother;
            statement+= '<div class="user_identity_image list_content">';
            statement+= '<img src=\'/mania/img/level/'+data.image+'\' width=\'20\'  alt=\'판매자\'>';
            statement+= '</div>';
            statement+= '<div class="list_content">';
            statement+= '<p class="identity">판매자</p>';
            statement+= '<div class="chat_ballon seller">'+text+'</div>';
            statement+= '<p class="chat_de">'+time+'</p>';
            statement+= '</div></div></li>';
            break;
    }
    return statement;
}

//에러 핸들러
function handleError(e){
    switch (e) {
        case 'not_connected':
            alert('1:1 채팅서버와 연결되지 않았습니다.\n잠시 후 다시 시도해주세요.');
            this.txt.focus();
            break;
        case 'connect_failed':
            alert('채팅 서버 연결에 실패했습니다.\n1:1 대화함을 이용해주세요.');
            this.chatWrapper.style.display = 'none';
            this.msgBox.style.display = 'block';
            break;
        case 'connect_error':
            alert('1:1 채팅 서버와 통신이 원활하지 않습니다.\n접속을 재시도 합니다.');
            break;
        case 'connect_timeout':
            break;
    }
}

//인포메이션 채팅
function infoChat(data){
    var statement = '<li class="info_chat">'+data.msg+'</li>'
    this.wrapper.insertAdjacentHTML('beforeend',statement);
    scrollBottom();
}

//채팅창 영역 계산
function resizeCalc(){
    var leng = this.txt.value.split('\n').length;
    return leng*20+30+'px';
}

//채팅 내역 스크롤
function scrollBottom(){
    this.contentWrapper.scrollTop = this.wrapper.scrollHeight;
}

//암/복호화
//비동기 처리를 위한 콜백
function cryptoMsg(data, type, filter, callback){
    // var data = {
    //     'msg':msg,
    //     'type':type,
    //     'filter':filter,
    //     'api_token':a_token
    // };
    data.api_token = a_token;
    ajaxRequest({
        url: '/api/myroom/chat/msg_encrypt',
        type:'POST',
        data:data,
        dataType:'json',
        success : function(res){
            switch (res.RST) {
                case true:
                    callback(res.MSG, res.TIME, res.FILTER);
                    break;
                case false:
                    break;
            }

        }
    });

}

//해당 방 채팅 내역
function getHistory(token){

    var data = {
        'token':token,
        'paging':this.pagination,
        'api_token':a_token
    };

    ajaxRequest({
        url: '/api/myroom/chat/msg_get',
        type:'POST',
        data:data,
        dataType:'json',
        success : function(res){
            var history = [];
            switch (res.RST) {
                case true:
                    history = JSON.parse(res.MSG);
                    if(history.length> 0)
                    {
                        for(var i=0; i<history.length; i++)
                        {

                            if(history[i].msg != null)
                            {
                                historyAppend(history[i])
                            }
                        }

                        if(res.NEXT){
                            this.pagination++;
                            this.wrapper.insertAdjacentHTML('afterbegin','<li class="more_chat_btn">이전대화보기 ▲</li>');
                            var moreBtn = document.querySelector('.more_chat_btn');
                            moreBtn.addEventListener('click',function(e){
                                moreBtnAction(e);
                            })
                        }
                        else
                        {
                            this.wrapper.insertAdjacentHTML('afterbegin','<li class="info_chat">이전 대화내역이 없습니다.</li>');
                        }
                    }

                    break;
                case false:
                    break;
            }
        }
    });

}

//메시지 처음인지 체크
function firstSend(token){
    var data ={
        'token':token
    };
    ajaxRequest({
        url: '/api/myroom/chat/msg_first_send',
        type:'POST',
        data:data,
        dataType:'json',
        success : function(res){

        }
    })
}

//더보기
function moreBtnAction(e){
    e.target.parentNode.removeChild(e.target);
    getHistory(this.userInfo.token);
}

function botChatter(){
    var data = {
        'me':'buyer',
        'msg':'안녕하세요.\n저는 김용 봇 입니다.',
        'another':true,
        'chat_de':new Date()
    };
    appendChat(data)
}

function dateFormatter(date){
    var splHours = date.split(' ');
    var splymd = splHours[0].split('-')
    var splhms = splHours[1].split(':')
    var year = splymd[0];
    var month = splymd[1];
    var day = splymd[2];
    var hours = splhms[0];
    var minutes = splhms[1];

    return new Date(year, month-1, day, hours, minutes)
}
