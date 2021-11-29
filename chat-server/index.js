const server = require('http').createServer();
const io = require('socket.io')(server);
const cheerio = require('cheerio');
const got = require('got');
var mysql = require('mysql');
let config = require('./config.js');
var cron = require('node-cron');
const axios = require('axios');
const {User} = require('./class/user')
const {Msg} = require('./class/msg')
const { v4: uuidv4 } = require('uuid');
const knex = require('knex')({
    client: 'mysql',
    connection: {
        host : '127.0.0.1',
        user : 'root',
        password : '',
        database : 'mania_item'
    },
});
// let connection = mysql.createConnection(config);
let sql_delete = `DELETE FROM m_game_rate`;
let sql_insert = "INSERT INTO m_game_rate (m_game_rate.id, m_game_rate.game, m_game_rate.type,m_game_rate.order) VALUES ?";
let insert_data = new Array();
let listUsers = new User();
let listMsg = new Msg();
var clientid = "",serverid = "",adminroomid = ""


const vgmUrl= 'https://www.gamemeca.com/ranking.php';

io.on('connection', client => {
    client.on('event', data => { /* … */ });
    client.on('disconnect', () => { /* … */ });
});
server.listen(7443, (error) =>{
    if(error) throw new Error(error)
    else console.log(`Server listening on port 7443`)
})

let presult = io.of('/');
presult.on("connection",(client) => {
    client.on('login',() => {
        if(client.handshake.query.token !=null){
            client.join(client.handshake.query.token);
        }
        client.broadcast.emit("roomJoin",{
                            msg: "대화상대가 입장했습니다.",
                            user_type: "system"
                            });
    })
    client.on('chat',(data)=>{
      client.broadcast.emit("listenChat",data);
    })
});

let public = io.of("/public");
public.on("connection",(client) => {

    client.on('disconnect', () => {
        let deleted_user = deleteUserByClientId(client.id);
        if(typeof deleted_user !=='undefined')
        {
            public.to(deleted_user.roomIdx).emit("receive",{header:{type:"LeaveUserId"},body:{userIdKey:deleted_user.id}})
            client.leave(deleted_user.roomIdx)
        }
    })

    client.on("send",(data,callback) => {
        let return_obj= {};
        let duplicated = 0;
        switch (data.header.type){
            case "login":

                if(data.body.cmd =="LOGIN"){
                    let token  = "";
                    if(data.body.userToken.trim() == "")
                        token = "NULL";
                    else
                        token  = data.body.userToken.trim()
                    let l = "";
                    if(data.body.roomIdx == "channel1")
                        l = "channel1";
                    else
                        l="lobby";
                    let u = listUsers.getUserFromIdAndRoomIdx(token,l,client.handshake.address);
                    if(u.length > 0)
                    {
                        u.forEach(individual => {
                            if (typeof public.sockets.get(individual.clientId) != 'undefined') {
                                let logout = 1;
                                if(token == individual.id && individual.ip == client.handshake.address && l=="channel1" && individual.lobby == "channel1"){
                                    logout = 0;
                                }
                                public.sockets.get(individual.clientId).emit("receive",{header:{type:"LOGIN"},body:{cmd:"ERROR",type:"DUPLICATE",logout:logout}});
                                public.sockets.get(individual.clientId).disconnect();
                            }
                            listUsers.deleteUserByClientId(individual.clientId)
                        });

                    }

                    if(data.body.roomIdx == "channel1"){
                        try{
                            (async function() {
                                client.join(data.body.roomIdx)
                                let user = await knex("users")
                                    .select( 'users.*')
                                    .where("users.userIdKey",token);

                                if(typeof  user == 'undefined' || user.length ==0  || typeof user[0]["id"] == "undefined" || user[0]["id"] == null ) {
                                    let date  = new Date();
                                    listUsers.addUser("null-"+uuidv4(), '', '', '', '', 0, client.id, data.body.roomIdx,date.getTime(),"","","channel1","/assets/images/mine/profile.png","",0,"muteOff","muteOff",0,client.handshake.address)
                                    return_obj = {header: {type: "ERROR"}, body: {type: "NOT_LOGIN",connectList:listUsers.getUsersByRoomIdx(data.body.roomIdx),msgList:listMsg.getMsgRoomIdx(data.body.roomIdx)}};
                                }
                                else {
                                    let item = new Array();
                                    let winning_history = "";
                                    let current_win = 0;
                                    var date = new Date();
                                    listUsers.addUser(token, user[0]["name"], user[0]["role"], user[0]["nickname"], "", current_win, client.id, data.body.roomIdx,date.getTime(),"",item.join("#::#"),"channel1","/assets/images/mine/profile.png","",0,"muteOff","muteOff","",client.handshake.address)
                                    return_obj = {header:{type:"INITMSG"},body:{roomIdx:data.body.roomIdx,freezeOnOff:"off",fixNoticeOnOff:"off",fixNoticeMsg:"",connectList:listUsers.getUsersByRoomIdx(data.body.roomIdx),msgList:listMsg.getMsgRoomIdx(data.body.roomIdx)}};

                                }

                                client.to(data.body.roomIdx).emit("receive",{header:{type:"ListUser"},body:{users:listUsers.getUserByClientId(client.id)}})
                                client.emit("receive",return_obj);
                            })()
                        }catch(e){
                            return_obj = {header:{type:"ERROR"},body:{type:"NOT_LOGIN"}};
                            client.emit("receive",return_obj);
                        }
                    }
                }

                break;
            case "MSG":
                let user = listUsers.getUserByClientId(client.id);


                if(typeof user == 'undefined' || user.id.includes("null-")){
                    return_obj = {header:{type:"ERROR"},body:{type:"NOT_LOGIN"}};
                    client.emit("receive",return_obj)
                }
                else{
                    var cur_diff = diffStrtotime(user.bytime);
                    if(data.body.roomIdx.length == 50 && user.mute == "muteOn"){
                        client.emit("receive",{header:{type:"NOTICE"},body:{type:"MUTEMSG"}})
                    }

                    else if(data.body.roomIdx == "channel1" && user.bytime!=0 && cur_diff!= true){
                        client.emit("receive",{header:{type:"NOTICE"},body:{type:"MUTEMSG",diff:cur_diff}})
                    }
                    else{

                        return_obj = {header:{type:"MSG"},body:createMessage(user.id,user.nickname,user.item,user.level,user.mark,data.body.msg,user.sex,user.winFixCnt,user.userType,data.body.roomIdx)};
                        if(listMsg.getMsgLengthFromRoomIdx(data.body.roomIdx) >= 30){
                            let msg = listMsg.getFirstMsgByRoomIdx(data.body.roomIdx);
                            listMsg.deleteMsgByUserToken(msg.id);
                        }
                        listMsg.createMsg(user.id,user.item,user.level,"",data.body.msg,user.nickname,user.sex,user.winFixCnt,client.id,data.body.roomIdx,user.userType);

                        public.to(data.body.roomIdx).emit("receive",return_obj)
                        if((this.clientid !=null && this.clientid !="") && (this.adminroomid == data.body.roomIdx || this.adminroomid == null || this.adminroomid.trim() == "")){
                            this.clientid.emit("receive",return_obj)
                        }
                    }
                }

                break;
        }
    })

});




cron.schedule('0 0 1 * * *', () => {
    got(vgmUrl).then(response => {
        const $ = cheerio.load(response.body);
        $('tr.ranking-table-rows').each((i, link) => {
            let type = "";
            if($(link).find(".ranking-static-img").hasClass("ranking-static-down"))
                type = 'down';
            if($(link).find(".ranking-static-img").hasClass("ranking-static-up"))
                type = 'up';
            let rankingChange = $(link).find(".rankChange").text();
            let rank = $(link).find(".rank").text();
            let game_name = $(link).find(".game-name").text();
            insert_data.push({id:rank, game : game_name,type:type,order:rankingChange});
        });
        if(insert_data.length > 0){
            try{
                (async function() {
                    let del = knex('m_game_rate')
                        .del();
                })();
            }catch(e){

            }
            try{

                (async function() {
                    let del =await knex('m_game_rate')
                        .where('id','>', 0)
                        .del();
                    let inserts = await knex('m_game_rate').insert(insert_data)
                })();
            }catch(e){
                console.log(e)
            }
        }
    }).catch(err => {
        console.log(err);
    });
});
cron.schedule('0 30 1 * * *', () => {
    axios.get('http://210.112.174.178/mania_export_xml')
        .then(response => {
            console.log(response.data)
        })
        .catch(error => {
            console.log(error);
        });
})


function deleteUserByClientId(id){
    let user = listUsers.getUserByClientId(id);
    listUsers.deleteUserByClientId(id);
    return user;
}

function getUsersByRoomIdx(roomIdx){
    return listUsers.getUsersByRoomIdx(roomIdx).length
}

function getUser(id){
    return listUsers.getUser(id)
}
function refreshChatByRoomIdx(roomIdx){
    listUsers.deleteUserByRoomIdx(roomIdx);
    listMsg.deleteMsgByRoomIdx(roomIdx);
}
function getUsers(){
    return listUsers.getUsers();
}
function deleteMsgByRoomIdx(roomIdx){
    listMsg.deleteMsgByRoomIdx(roomIdx);
}


function diffStrtotime(bytime){
    var curr = Math.floor(new Date().getTime() / 1000);
    var dif = parseInt(bytime) - curr;
    if(dif <=0 || bytime == 0) return true;
    else{
        if(dif <= 60) return Math.floor(dif)+"초";
        else if(dif <3600) return Math.floor(dif / 60) + "분";
        else return Math.ceil(dif / 3600) + "시간";
    }
}

function createMessage(id, nickname,item,level,mark,msg,sex,winFixCnt,userType,roomIdx=""){
    return {
        id,
        nickname,
        item,
        level,
        mark,
        msg,
        sex,
        winFixCnt,
        userType,
        roomIdx
    }
}



