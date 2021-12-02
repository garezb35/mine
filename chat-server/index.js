const server = require('http').createServer();
const io = require('socket.io')(server);
const cheerio = require('cheerio');
const got = require('got');
var mysql = require('mysql');
let config = require('./config.js');
var cron = require('node-cron');
let connection = mysql.createConnection(config);
let sql_delete = `DELETE FROM m_game_rate`;
let sql_insert = "INSERT INTO m_game_rate (m_game_rate.id, m_game_rate.game, m_game_rate.type,m_game_rate.order) VALUES ?";
let insert_data = new Array();
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
    // client.on('disconnect', () => {
    //     client.broadcast.emit("roomJoin",{
    //                         msg: "대화상대가 퇴장했습니다.",
    //                         user_type: "system"
    //                         });
    // })

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
            insert_data.push([rank,game_name,type,rankingChange]);
        });
        if(insert_data.length > 0){
            connection.query(sql_delete, 1, (error, results, fields) => {
                if (error)
                    return console.error(error.message);
                connection.query(sql_insert, [insert_data], function(err) {
                    console.log(err)
                });
            });
        }
    }).catch(err => {
        console.log(err);
    });
});

