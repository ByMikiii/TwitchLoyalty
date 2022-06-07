import fetch from 'node-fetch';
import queryString from 'query-string';
import mysql from 'mysql';

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "TwitchLoyalty"
});

import { clientId, secret, accessToken } from './settings.js';

var isLive;
var listOfUsers;

function appRunning() {
  var streamerName = 'resttpowered';

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

                listOfUsers = obj.chatters['viewers'];
                console.log('Number of chatters: ' + obj.chatter_count);

                insertUser(0);

              })

        }

      })
}


appRunning();



function insertUser(value) {
  var recentUsername = listOfUsers[value];

  //CREATES USER IN DATABASE
  con.connect(function (err) {
    var sql = "INSERT INTO users (username, points) VALUES ('" + recentUsername + "', 1)";
    con.query(sql, function (err, result) {
      if (err) throw err;
      console.log(recentUsername + ' added.');
    }
    )
  }
  )

  if (value + 1 < listOfUsers.length) {
    setTimeout(() => {
      value++;
      insertUser(value);
    }, 10)
  }
}


// create database TwitchLoyalty;
// use TwitchLoyalty;
// create table users
// (
//     id       int auto_increment
//         primary key,
//     username varchar(64) null,
//     points   int         null
// );