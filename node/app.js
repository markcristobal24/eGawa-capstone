const http = require('http');
const server = http.createServer();
const io = require('socket.io')(server);

io.on('connection', (socket) => {
    console.log('A user connected');

    socket.io('chat message', (msg) => {
        console.log('Message:', msg);
        io.emit('chat message', msg);
    });

    socket.io('disconnect', () => {
        console.log('User disconnected');
    });
});

server.listen(3000, () => {
    console.log('Socket.IO server listening on *:3000');
});