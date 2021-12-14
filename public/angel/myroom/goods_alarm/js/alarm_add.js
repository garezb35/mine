var data;

window.onload = function(){
    init()
};

function init(){

    var gameCode = document.querySelector('#game_code_selector');
    var submitBtn = document.getElementById('submit_btn');
    var changeTable = document.querySelectorAll('.change_table');
    var accountType = document.getElementsByName('account_type');
    var alarmType = document.getElementsByName('user_alarm_type');
    if(gameCode != null)
    {
        requestData(function(){
            this.data.game.forEach(function(game,index){
                var el = document.createElement('option')
                el.innerText = game.game_name;
                el.setAttribute('value',game.game_code)
                gameCode.appendChild(el);
                if(index == 0)
                {
                    changeGame(game.game_code)
                }
            });

            gameCode.addEventListener('change', function(){
                changeGame(this.value)
            })
        });
    }


    submitBtn.addEventListener('click',function(){
        submitAction()
    });

    for(var i=0; i<changeTable.length; i++)
    {
        changeTable[i].addEventListener('change', function(e){

            chageTableAction(e.target.value)
        })
    }

    for(var i=0; i<accountType.length; i++)
    {
        accountType[i].addEventListener('change',function(){
            readonlyAccount(this.value)
        })
    }

    for(var i=0; i<alarmType.length; i++)
    {
        alarmType[i].addEventListener('change',function(){
            changeAlarmContent(this.value)
        })
    }

}



function requestData(callback){
    ajaxRequest({
        url: '_ajax_process.php',
        type:'post',
        dataType: 'json',
        data: {
            'mode': 'game'
        },
        success: function(res) {
            if (res.RST === false) {
                return;
            }

            var gameJSON = res.DAT
                , searchJSON = []
                , gameLen = gameJSON.length
                , i;

            for (i = 0; i < gameLen; i++) {
                searchJSON.push(gameJSON[i]);
            }

            ajaxRequest({
                url: '/api/_json/gameserverlist.json',
                dataType: 'json',
                cache: false,
                success: function(res) {

                    _gamedata.game = searchJSON;
                    _gamedata.server = res.serverlist;
                    this.data = _gamedata;
                    if (callback) {
                        callback();
                    }
                }
            });

        },
        error: function (e) {
            alert('ì„œë²„ì™€ì˜ ì ‘ì†ì´ ì›í™œí•˜ì§€ ì•ŠìŠµë‹ˆë‹¤.\nìž ì‹œí›„ ë‹¤ì‹œ ì‹œë„í•´ì£¼ì„¸ìš”.' + e.message);
            return;
        }
    });
}

function changeGame(code){
    var serverCode = document.querySelector('#server_code_selector');
    var sortArr = [];
    serverCode.innerHTML = '';
    this.data.server.forEach(function(server,index){
        if(server.GC && server.GC === Number(code) && server.N.substring(0,1) != '-')
        {
            sortArr.push(server)
        }
    });

    sortArr.sort(function(a,b){
        if(Number(a.BG) > Number(b.BG))
        {
            return 1;
        }
        if(Number(a.BG) < Number(b.BG))
        {
            return -1;
        }
        return 0;
    });

    sortArr.forEach(function(server){
        var el = document.createElement('option')
        el.innerText = server.N;
        el.setAttribute('value',server.C);
        serverCode.appendChild(el)
    })
}

function submitAction(){
    var form = document.getElementById('alarmAdd');
    var subject = document.querySelectorAll('.add_subject');
    var target1 = document.getElementById('game_code_selector');
    var target2 = document.getElementById('server_code_selector');
    var validation = {
        flag:false,
        msg:''
    };
    var filterArr = [];

    if(target1 != null && target2 != null)
    {
        document.getElementById('game_code').value = target1.options[target1.selectedIndex].value;
        document.getElementById('server_code').value =target2.options[target2.selectedIndex].value;
        document.getElementById('game_code_text').value = target1.options[target1.selectedIndex].text;
        document.getElementById('server_code_text').value =target2.options[target2.selectedIndex].text;
    }


    for(var i=0; i<subject.length; i++)
    {
        if(filterArr.indexOf(subject[i].value) != -1)
        {
            validation.flag = false;
            validation.msg = 'í‚¤ì›Œë“œë¥¼ ì¤‘ë³µí•˜ì—¬ ìž…ë ¥í•  ìˆ˜ ì—†ìŠµë‹ˆë‹¤.';
            break;
        }
        else
        {
            if(subject[i].value != '')
            {
                if(subject[i].value.length < 2)
                {
                    validation.flag = false;
                    validation.msg = 'í‚¤ì›Œë“œëŠ” 2ê¸€ìž ì´ìƒ ìž…ë ¥í•´ì£¼ì„¸ìš”';
                    break;
                }

                if(subject[i].value.substring(0, 1) != ' ')
                {
                    filterArr.push(subject[i].value);
                    validation.flag = true;
                }
                else
                {
                    validation.flag = false;
                    validation.msg = 'ê¸€ìž ì•žì— ê³µë°±ì´ ì¶”ê°€ë  ìˆ˜ ì—†ìŠµë‹ˆë‹¤.';
                    break;
                }
            }
            else
            {
                validation.msg = 'ì•Œë¦¼ì— ë“±ë¡í•  í…ìŠ¤íŠ¸ë¥¼ ë“±ë¡í•´ì£¼ì„¸ìš”'
            }
        }

    }

    if(document.getElementById('compen') != null && document.getElementById('sell_compen') != null)
    {
        if(document.getElementById('compen').checked && document.getElementById('sell_compen').checked)
        {
            validation.flag = false;
            validation.msg = 'ë³´ìƒì¡°ê±´ì€ í•˜ë‚˜ë§Œ ì„ íƒí•´ì£¼ì„¸ìš”.';
        }
    }

    if(validation.flag)
    {
        form.submit();
    }
    else
    {
        alert(validation.msg);
    }
}

function chageTableAction(value){
    var table = document.getElementById('table_wrapper');
    var submitBtn = document.getElementById('submit_btn');
    var wrapper = document.getElementById('alarm_change_wrapper');
    wrapper.innerHTML = '';
    var el = '';
    if(value == 1)
    {
        el ='<div class="goods_radio_wrapper">'
        el += '<label><input type="checkbox" name="compen" id="compen" class="g_checkbox"> 200% ë³´ìƒ ë¬¼í’ˆ</label>'
        el += '<label><input type="checkbox" name="sell_compen" id="sell_compen" class="g_checkbox"> 200% êµ¬ë§¤ë³´ìƒ</label>'
        el +='<label><input type="checkbox" name="excellent" id="excellent" class="g_checkbox"> ìš°ìˆ˜ì¸ì¦ ë¬¼í’ˆ</label></div>'
        wrapper.innerHTML = el;
        table.classList.remove('g_green_table');
        table.classList.add('g_blue_table');
        submitBtn.classList.remove('buy');
        submitBtn.classList.add('sell')
    }
    else
    {

        el ='<div class="goods_radio_wrapper">'
        el += '<label><input type="checkbox" name="direct" id="direct" class="g_checkbox"> ì¦‰ì‹œêµ¬ë§¤ ë¬¼í’ˆ</label>'
        el += '<label><input type="checkbox" name="excellent" id="excellent" class="g_checkbox"> ìš°ìˆ˜ì¸ì¦ ë¬¼í’ˆ</label></div>'
        wrapper.innerHTML = el;
        table.classList.remove('g_blue_table');
        table.classList.add('g_green_table');
        submitBtn.classList.remove('sell');
        submitBtn.classList.add('buy');
    }

}

function readonlyAccount(value)
{
    var purchaseType = document.getElementsByName('purchase_type');
    var payment = document.getElementsByName('payment_existence');
    var multiAccess = document.getElementsByName('multi_access');
    if(value == 2)
    {
        for(var i=0; i<purchaseType.length; i++)
        {
            if(i>0)
            {
                purchaseType[i].setAttribute('disabled', true)
                purchaseType[0].checked = true
            }
        }

        for(var i=0; i<payment.length; i++)
        {
            if(i>0)
            {
                payment[i].setAttribute('disabled', true)
                payment[0].checked = true
            }

        }

        for(var i=0; i<multiAccess.length; i++)
        {
            if(i>0)
            {
                multiAccess[i].setAttribute('disabled', true)
                multiAccess[0].checked = true
            }
        }
    }
    else
    {
        for(var i=0; i<purchaseType.length; i++)
        {
            if(i>0)
            {
                purchaseType[i].removeAttribute('disabled')
            }

        }

        for(var i=0; i<payment.length; i++)
        {
            if(i>0)
            {
                payment[i].removeAttribute('disabled')
            }

        }

        for(var i=0; i<multiAccess.length; i++)
        {
            if(i>0)
            {
                multiAccess[i].removeAttribute('disabled')
            }

        }
    }
}

function changeAlarmContent(value)
{
    switch (value) {
        case "1":
            document.querySelectorAll('.character_noti')[2].textContent = '- ëª¨ë°”ì¼ì•± PUSHë¡œ ì•Œë¦¼ì„ ë°›ìœ¼ì‹œë ¤ë©´ ì•„ì´í…œë§¤ë‹ˆì•„ì•± ì„¤ì¹˜ ë° ë¡œê·¸ì¸ì´ ë˜ì–´ ìžˆì–´ì•¼ í•©ë‹ˆë‹¤.';
            document.querySelectorAll('.character_noti')[3].textContent = '- ì•±PUSH ì•Œë¦¼ì€ ëª¨ë°”ì¼ì•± > í™˜ê²½ì„¤ì • > ë§ˆì¼€íŒ…ì •ë³´PUSHì•Œë¦¼ì—ì„œ ìˆ˜ì‹ ë™ì˜ ìƒíƒœì¼ë•Œë§Œ ë°œì†¡ë©ë‹ˆë‹¤.';
            break;
        case "2":
            document.querySelectorAll('.character_noti')[2].textContent = '- SMSì•Œë¦¼ì€ ì•Œë¦¼ ì‹œì ì—ì„œì˜ ë“±ë¡ëœ ê³ ê°ë‹˜ íœ´ëŒ€í°ë²ˆí˜¸ë¡œ ë°œì†¡ë©ë‹ˆë‹¤.';
            document.querySelectorAll('.character_noti')[3].textContent = '- SMSì•Œë¦¼ì€ ë§ˆì´ë£¸ > ê°œì¸ì •ë³´ìˆ˜ì • íŽ˜ì´ì§€ì—ì„œ â€˜ê´‘ê³ ì„±ì •ë³´ìˆ˜ì‹ ë™ì˜-SMSìˆ˜ì‹ ë™ì˜â€™ ìƒíƒœì¼ë•Œë§Œ ë°œì†¡ë©ë‹ˆë‹¤.';
            break;
    }
}
