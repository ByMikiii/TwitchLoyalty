import fetch from 'node-fetch';
import queryString from 'query-string';


import { clientId, secret, accessToken } from './settings.js';

var isLive;


function appRunning() {
  var streamerName = 'donatolive';

  //CHECKS IF STREAMER IS STREAMING
  fetch('https://api.twitch.tv/helix/search/channels?query=' + streamerName, {
    headers: {
      'Authorization': 'Bearer ' + accessToken,
      'Client-Id': clientId
    }
  }).then(
    response => response.text())
    .then(
      data => {
        isLive = data.includes("\"is_live\":true");
        //IF STREAMER IS OFFLINE 
        if (!isLive) {
          console.log(streamerName + ' is offline! :(');
          setTimeout(appRunning, 1000);

        }
        //IF STREAMER IS ONLINE
        else {
          console.log(streamerName + ' is live! :)');

          //GETS ALL CHATTERS
          fetch('https://tmi.twitch.tv/group/user/' + streamerName + '/chatters')
            .then(
              response => response.text())
            .then(
              data => {
                var json = data;
                var obj = JSON.parse(json);

                for (var i = 0; i < obj.chatters['viewers'].length; i++) {
                  console.log(obj.chatters['viewers'][i]);
                }

                console.log('Number of chatters: ' + obj.chatter_count);

              })

        }

      })
}


appRunning();