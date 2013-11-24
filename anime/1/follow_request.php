<?php
require_once('config.php');
require_once('codebird-php-2.4.1/src/codebird.php');

\Codebird\Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
$cb = \Codebird\Codebird::getInstance();

session_start();
    // verify the token
    $cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
    unset($_SESSION['oauth_verify']);

    // get the access token
    $reply = $cb->oauth_accessToken(array(
        'oauth_verifier' => true
    ));
    // store the token (which is different from the request token!)
//    $_SESSION['oauth_token'] = $reply->oauth_token;
//    $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
//    $cb->setToken($reply->oauth_token,$reply->oauth_token_secret);
/*
    $me = $cb->account_verifyCredentials();
    var_dump($me);
    exit;
*/
    $params = array(
		'screen_name' => 'from_shibuya',
		);
    $follow = $cb->friendships_create($params);

  header('Location:http://rhyme.jp/fromshibuya/anime/1/answer.php');
