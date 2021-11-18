const server = require('http').createServer();
const io = require('socket.io')(server);
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
