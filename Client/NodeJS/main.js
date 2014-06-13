var http = require('http');
var process = require('child_process');
var faye = require('faye');
var fs = require('fs');
var path = require('path');
var name = 'pcradio1';
var htmlBaseName = "C:\\Users\\Public\\Documents\\Broadcast Partners\\PC-Radio 6\\Web\\Simple.txt";
var client = new faye.Client('http://192.168.178.118:1385/push');
client.subscribe('/clients', function(message) {
    console.log('Activated, sending.');
    if (message.target === name) {
        console.log('Activated, sending.');
        var requestUrl = message.url;
        var urlParts = requestUrl.split("/");
        urlParts.shift();
        if (urlParts.length > 0) {
            var actionParts = urlParts[0].split(":");
            urlParts.shift();
            if (actionParts.length === 2 && actionParts[0] === "action") {
                //res.writeHead(200, {'Content-Type': 'text/plain'});
                switch (actionParts[1]) {
                    case "Playlist":
                        var dateWanted = new Date(Date.parse(urlParts[0]));
                        var dateNow = new Date(Date.now());
                        var yearsDiff = dateWanted.getYear() - dateNow.getYear();
                        var monthDiff = dateWanted.getMonth() - dateNow.getMonth();
                        var reshifts = (yearsDiff * 12) + monthDiff;
                        var dateMove = dateWanted.getDate() - 1;
                        var p = process.exec("Playlist " + reshifts + " " + dateMove);
                        p.on('exit', function(code) {
                            fs.readFile(htmlBaseName, 'utf8', function(err, data) {
                                client.publish('/dataResult', {from: name, data: data});
                            });
                        });
                        //res.end("Wanted date: " + dateWanted.toDateString() + ". Reshifts: " + reshifts + ", day moves: " + dateMove);
                        break;
                    case "ExportDB":
                        var file = path.resolve(path.dirname(require.main.filename), 'databank.txt');
                        console.log("ExportDB " + file);
                        var p = process.exec("ExportDB " + file);
                        p.on('exit', function(code) {
                            fs.readFile('databank.txt', 'utf8', function(err, data) {
                                client.publish('/dataResult', {from: name, data: data});
                            });
                        });
                        break;
                    default:
                        for (var dt in urlParts) {
                            urlParts[dt] = unescape(urlParts[dt]);
                        }
                        var p = process.exec(actionParts[1] + ' "' + urlParts.join('" "') + '"');
                        p.on('exit', function(code) {
                            
                            client.publish('/dataResult', {from: name, data: 'Action ' + actionParts[1] + ' succeeded.\n'});
                            //res.end('Action ' + actionParts[1] + ' succeeded.\n');
                        });
                        break;
                }

                //res.end('Action: ' + actionParts[1] + '. Arguments: ' + JSON.stringify(urlParts) + '\n');
            } else {
                //res.writeHead(403, {'Content-Type': 'text/plain'});
                //res.end('Forbidden.\n');
            }
        } else {
            //res.writeHead(403, {'Content-Type': 'text/plain'});
            //res.end('Forbidden.\n');
        }
    }
});
console.log("Start");