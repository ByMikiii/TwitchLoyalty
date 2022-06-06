import fetch from 'node-fetch';

import { clientId, secret, accessToken } from './settings.js';

fetch('https://api.twitch.tv/helix/users?login=twitchdev', {
  headers: {
    'Authorization': 'Bearer ' + accessToken,
    'Client-Id': clientId
  }
}).then(response => response.text())
  .then(data => console.log(data));


