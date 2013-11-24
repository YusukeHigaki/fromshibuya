<?php

require_once('config.php');
require_once('codebird-php-2.4.1/src/codebird.php');

echo '<style type="text/css"> body { background:#fff;} .fs23 { font-size:23px !important; font-weight:bold; }
.fsw { color:#000 !important; } a:link {color:#00ccff;}a:visited {color:#00ccff;}a:hover {color:#00ccff;}</style>';

\Codebird\Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
$cb = \Codebird\Codebird::getInstance();

session_start();
if (! isset($_SESSION['oauth_token'])) {
    // get the request token
    $reply = $cb->oauth_requestToken(array(
        'oauth_callback' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
    ));

    // store the token
    $cb->setToken($reply->oauth_token, $reply->oauth_token_secret);
    $_SESSION['oauth_token'] = $reply->oauth_token;
    $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
    $_SESSION['oauth_verify'] = true;

    // redirect to auth website
    $auth_url = $cb->oauth_authorize();
    header('Location: ' . $auth_url);
    die();

} elseif (isset($_GET['oauth_verifier']) && isset($_SESSION['oauth_verify'])) {
    // verify the token
    $cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
    unset($_SESSION['oauth_verify']);

    // get the access token

    $reply = $cb->oauth_accessToken(array(
        'oauth_verifier' => $_GET['oauth_verifier']
    ));
    // store the token (which is different from the request token!)
    $_SESSION['oauth_token'] = $reply->oauth_token;
    $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
    $cb->setToken($reply->oauth_token,$reply->oauth_token_secret);
/*
    $me = $cb->account_verifyCredentials();
    var_dump($me);
    exit;
*/
    //@from_shibuyaアカウントをフォローしてもらう
    echo '<br ><br ><br ><br ><center><img src="images/follow.png"></center><br /><center><p class="fs23 fsw"><a href="follow_request.php">@from_shibuyaをフォロー</a>して答えを見てみましょう。</p></center><br />';

    exit;

    // send to same URL, without oauth GET parameters
    header('Location: ' . basename(__FILE__));
    die();
}

// assign access token on each page load
$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

header('Location:http://rhyme.jp/fromshibuya/anime/1/answer.php');
?>

