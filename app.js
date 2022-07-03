import fetch from 'node-fetch';
import queryString from 'query-string';
import mysql from 'mysql';

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "root",
  database: "TwitchLoyalty"
});

import { clientId, secret, accessToken } from './settings.js';

var isLive;
var listOfUsers;
var numberOfAddedUsers = 0;
var usersChecked = 0;

const streamerName = 'dvorson';//ENTER TWITCH USERNAME
const liveTimer = 60 * 1000; //TIME HOW OFTEN APP CHECKS IF USER IS STREAMING
const pointsTimer = 60 * 1000; //TIME HOW OFTEN APP ADDS POINTS TO USERS
const pointsDelay = 1 //DELAY BETWEEN POINTS INSERT

function appRunning() {
  usersChecked = 0;
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
          setTimeout(appRunning, liveTimer);

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
                //console.log('Number of chatters: ' + obj.chatter_count);
                insertUser(0);

              })
        }
      })
}

appRunning();

function insertUser(value) {
  var recentUsername = listOfUsers[value];
  con.connect(function (err) {
    var sql = "SELECT points FROM users WHERE username = '" + recentUsername + "'";
    con.query(sql, function (err, result) {
      if (err) throw err;
      if (result.length > 0) {
        var newUserPoints = result[0]['points'] + 1;
        addPointsToUser(recentUsername, newUserPoints);
      } else createUserDB(recentUsername);
    });
  });
  usersChecked++;
  if (value + 1 < listOfUsers.length) {
    setTimeout(() => {
      value++;
      insertUser(value);
    }, pointsDelay)
  }else {
    setTimeout(() => {
      con.query("SELECT * FROM users ORDER BY points DESC", function (err, result, fields) {
        if (err) throw err;
        for (var i = 0; i < result.length; i++) {
          var usernamename = result[i]['username']
          var userWatchtime = result[i]['watchtime'];
          userWatchtime = userWatchtime + 0.0166666667; //1 minute in hours
          var maxPoints;
          result[i]['points'] > result[i]['max_points'] ? maxPoints = result[i]['points'] : maxPoints = result[i]['max_points'];
          var order = i + 1;

          var sql = "UPDATE users SET user_order = " + order + ", max_points = " + maxPoints + ", watchtime = " + userWatchtime + "  WHERE username = '" + usernamename + "'";
          if(i == result.length-1){
            results(numberOfAddedUsers,usersChecked,pointsTimer,pointsDelay);
          }
          con.query(sql, function (err, result) {
            if (err) throw err;
          });
        }
      })
    }, 1000)
  }
}

function results(numberOfAddedUsers, usersChecked, pointsTimer, pointsDelay){
  //console.log(numberOfAddedUsers + ' new users.');
  //console.log(usersChecked + ' users checked.');

  const date = Date();
  const new_date = new Date(date);
  console.log(new_date.getHours()+':'+new_date.getMinutes()+':'+new_date.getSeconds()+':'+new_date.getMilliseconds());


  numberOfAddedUsers = 0;
  setTimeout(appRunning, pointsTimer - (usersChecked * pointsDelay) - 2000);
  usersChecked = 0;
}


//CREATES USER IN DB
function createUserDB(recentUsername) {
  con.connect(function (err) {
    var sql = "INSERT INTO users (username, points) VALUES ('" + recentUsername + "', 1)";
    con.query(sql, function (err, result) {
      if (err) throw err;
      //console.log(recentUsername + ' created.');
    }
    )
  }
  )
  numberOfAddedUsers++;
}

function addPointsToUser(recentUsername, newUserPoints) {
  con.connect(function (err) {
    var sql = "UPDATE users SET points = " + newUserPoints + " WHERE username = '" + recentUsername + "'";
    con.query(sql, function (err, result) {
      if (err) throw err;
     //console.log('Points added to ' + recentUsername);
    }
    )
  }
  )
}



//
// drop database TwitchLoyalty;
// create database TwitchLoyalty;
// use TwitchLoyalty;
// create table users
//   (
//     user_id        int auto_increment
//         primary key,
//     user_order int default 9999,
//     username varchar(64) null,
//     points   int         null,
//     max_points int default 0,
//     admin BOOLEAN default 0,
//     watchtime float default 0
//   );
// create table items
//   (
//     item_id       int auto_increment
//         primary key,
//     name varchar(64) null,
//     price   int         null,
//     active BOOLEAN default 1,
//     description text,
//     items_left int default 0,
//     url_image text NULL
//   );
// create table redeemed_items
//   (
//     redeemed_id       int auto_increment
//     primary key,
//     username varchar(64) null,
//     item_name varchar(64) null,
//     price int,
//     date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
//   );
