<?php 

if(!isset($_SESSION)){
  session_start();
  require_once($_SERVER['DOCUMENT_ROOT'] . '/loyalty/scripts/connection.php');
  require_once($_SERVER['DOCUMENT_ROOT'] . '/loyalty/scripts/getCurrentUser.php');
  if(isset($currentUser['points'])){
    $_SESSION['points'] = $currentUser['points'];
  }
}

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/loyalty/dist/output.css" rel="stylesheet">
  <title><?php echo $pageTitle;?></title>
</head>

<body class='bg-darkblue-100 text-gray-400'>
  <header
    class='text-redpink-100 font-medium text-lg relative border-b border-redpink-100 p-2 px-5 flex items-center h-14'>
    <a href="/loyalty/" class=' mr-6 hover:mb-0.5'>Store</a>
    <a href="/loyalty/leaderboard/" class=' mr-6 hover:mb-0.5'>Leaderboard</a>
    <?php if( isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1): ?>
    <a href="/loyalty/manager/" class=' hover:mb-0.5'>Manage Items</a>
    <?php endif; ?>
    <?php if(!isset($_SESSION['username'])): ?>
    <button class='text-gray-900 bg-redpink-100 p-1.5 px-2 font-bold rounded-md hover:brightness-110 ml-auto items-end'>
      <a
        href="https://id.twitch.tv/oauth2/authorize?response_type=code&client_id=pl88xj79ewii5nqmb51lnokicqo1ri&redirect_uri=http://localhost/loyalty/redirect.php&scope=channel%3Amanage%3Apolls+channel%3Aread%3Apolls&state=c3ab8aa609ea11e793ae92361f002671">Login
        in with Twitch</a></button>
    <?php
  elseif(isset($_SESSION['username'])): ?>
    <div class="points absolute left-1/2 -translate-x-1/2 items-center flex flex-row">
      <svg class="svg-icon w-6" viewBox="0 0 20 20">
        <path class='fill-current'
          d="M4.319,8.257c-0.242,0-0.438,0.196-0.438,0.438c0,0.243,0.196,0.438,0.438,0.438c0.242,0,0.438-0.196,0.438-0.438C4.757,8.454,4.561,8.257,4.319,8.257 M7.599,10.396c0,0.08,0.017,0.148,0.05,0.204c0.034,0.056,0.076,0.104,0.129,0.144c0.051,0.04,0.112,0.072,0.182,0.097c0.041,0.015,0.068,0.028,0.098,0.04V9.918C7.925,9.927,7.832,9.958,7.747,10.02C7.648,10.095,7.599,10.22,7.599,10.396 M15.274,6.505H1.252c-0.484,0-0.876,0.392-0.876,0.876v7.887c0,0.484,0.392,0.876,0.876,0.876h14.022c0.483,0,0.876-0.392,0.876-0.876V7.381C16.15,6.897,15.758,6.505,15.274,6.505M1.69,7.381c0.242,0,0.438,0.196,0.438,0.438S1.932,8.257,1.69,8.257c-0.242,0-0.438-0.196-0.438-0.438S1.448,7.381,1.69,7.381M1.69,15.269c-0.242,0-0.438-0.196-0.438-0.438s0.196-0.438,0.438-0.438c0.242,0,0.438,0.195,0.438,0.438S1.932,15.269,1.69,15.269M14.836,15.269c-0.242,0-0.438-0.196-0.438-0.438s0.196-0.438,0.438-0.438s0.438,0.195,0.438,0.438S15.078,15.269,14.836,15.269M15.274,13.596c-0.138-0.049-0.283-0.08-0.438-0.08c-0.726,0-1.314,0.589-1.314,1.314c0,0.155,0.031,0.301,0.08,0.438H2.924c0.049-0.138,0.081-0.283,0.081-0.438c0-0.726-0.589-1.314-1.315-1.314c-0.155,0-0.3,0.031-0.438,0.08V9.053C1.39,9.103,1.535,9.134,1.69,9.134c0.726,0,1.315-0.588,1.315-1.314c0-0.155-0.032-0.301-0.081-0.438h10.678c-0.049,0.137-0.08,0.283-0.08,0.438c0,0.726,0.589,1.314,1.314,1.314c0.155,0,0.301-0.031,0.438-0.081V13.596z M14.836,8.257c-0.242,0-0.438-0.196-0.438-0.438s0.196-0.438,0.438-0.438s0.438,0.196,0.438,0.438S15.078,8.257,14.836,8.257 M12.207,13.516c-0.242,0-0.438,0.196-0.438,0.438s0.196,0.438,0.438,0.438s0.438-0.196,0.438-0.438S12.449,13.516,12.207,13.516 M8.812,11.746c-0.059-0.043-0.126-0.078-0.199-0.104c-0.047-0.017-0.081-0.031-0.117-0.047v1.12c0.137-0.021,0.237-0.064,0.336-0.143c0.116-0.09,0.174-0.235,0.174-0.435c0-0.092-0.018-0.17-0.053-0.233C8.918,11.842,8.87,11.788,8.812,11.746 M18.78,3.875H4.757c-0.484,0-0.876,0.392-0.876,0.876V5.19c0,0.242,0.196,0.438,0.438,0.438c0.242,0,0.438-0.196,0.438-0.438V4.752H18.78v7.888h-1.315c-0.242,0-0.438,0.196-0.438,0.438c0,0.243,0.195,0.438,0.438,0.438h1.315c0.483,0,0.876-0.393,0.876-0.876V4.752C19.656,4.268,19.264,3.875,18.78,3.875 M8.263,8.257c-1.694,0-3.067,1.374-3.067,3.067c0,1.695,1.373,3.068,3.067,3.068c1.695,0,3.067-1.373,3.067-3.068C11.33,9.631,9.958,8.257,8.263,8.257 M9.488,12.543c-0.062,0.137-0.147,0.251-0.255,0.342c-0.108,0.092-0.234,0.161-0.378,0.209c-0.123,0.041-0.229,0.063-0.359,0.075v0.347H8.058v-0.347c-0.143-0.009-0.258-0.032-0.388-0.078c-0.152-0.053-0.281-0.128-0.388-0.226c-0.108-0.098-0.191-0.217-0.25-0.359c-0.059-0.143-0.087-0.307-0.083-0.492h0.575c-0.004,0.219,0.046,0.391,0.146,0.518c0.088,0.109,0.207,0.165,0.388,0.185v-1.211c-0.102-0.031-0.189-0.067-0.3-0.109c-0.136-0.051-0.259-0.116-0.368-0.198c-0.109-0.082-0.198-0.183-0.265-0.306c-0.067-0.123-0.101-0.275-0.101-0.457c0-0.159,0.031-0.298,0.093-0.419c0.062-0.121,0.146-0.222,0.252-0.303S7.597,9.57,7.735,9.527C7.85,9.491,7.944,9.474,8.058,9.468V9.134h0.438v0.333c0.114,0.005,0.207,0.021,0.319,0.054c0.134,0.04,0.251,0.099,0.351,0.179c0.099,0.079,0.178,0.18,0.237,0.303c0.059,0.122,0.088,0.265,0.088,0.427H8.916c-0.007-0.169-0.051-0.297-0.134-0.387C8.712,9.968,8.626,9.932,8.496,9.919v1.059c0.116,0.035,0.213,0.074,0.333,0.118c0.145,0.053,0.272,0.121,0.383,0.203c0.111,0.083,0.2,0.186,0.268,0.308c0.067,0.123,0.101,0.273,0.101,0.453C9.581,12.244,9.549,12.406,9.488,12.543">
        </path>
      </svg>
      <p class='ml-2'><?php echo $_SESSION['points']?></p>
    </div>
    <div class="dropdown inline-block relative ml-auto items-end">
      <a id='username' class='text-redpink-100 font-bold text-lg relative p-2 py-3' href="/loyalty/profile/"> <?php
        echo $_SESSION['username']; ?></a>
      <div id='dropdown'
        class='bg-darkblue-100 p-1.5 dropdown-items flex flex-col text-center absolute rounded-md border'>
        <a href="/loyalty/profile/" class='text-gray-100 hover:text-redpink-100 mb-0.5'>Profile</a>
        <a href="/loyalty/profile/" class='text-gray-100 hover:text-redpink-100 mb-0.5'>Settings</a>
        <a href="/loyalty/scripts/logout.php" class='text-red-600 hover:brightness-125'>Logout</a>
      </div>
    </div>
    <?php endif; ?>
  </header>