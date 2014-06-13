var http = require('http'),
    faye = require('faye');

var bayeux = new faye.NodeAdapter({mount: '/push', timeout: 45});
var client = bayeux.getClient();
bayeux.on('subscribe', function(clientId) {
  console.log("Client subscribed. " + clientId);
});

var server = http.createServer(function(request, response) {
        var target = "pcradio1";
        console.log('Activated, sending.');
        client.publish('/clients', {url: request.url, target: target});
        response.writeHead(200, {'Content-Type': 'text/plain'});
        client.subscribe('/dataResult', function(message){
            if(message.from === target){
                response.end(message.data);
            }
        });
        
    //client.subscribe
});
client.subscribe('/status', function(message){
    
});
bayeux.attach(server);
server.listen(1385);

console.log("Attached.");