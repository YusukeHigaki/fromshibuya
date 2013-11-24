<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="layout.css" type="text/css" />
</head>
<body>
<br /><br />
<center><img src="images/answer.png"></center>
<center>

<?php
require_once('config.php');
require_once('codebird-php-2.4.1/src/codebird.php');
\Codebird\Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
$cb = \Codebird\Codebird::getInstance();
session_start();
$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
$reply = $cb->statuses_update('status=ふつうに騙されたｗ【大人のなぞなぞ】 http://rhyme.jp/fromshibuya/erotic/1');

?>
<a href="http://twitter.com/share?url=http://rhyme.jp/fromshibuya/erotic/1/&text=ふつうに騙されたｗ【大人のなぞなぞ】&via=from_shibuya&"><img src="images/answer_btn.png" alt="ツイートする" /></a>


<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

</center><br />
<br />
<br />
<br />
<br />
</body>
</html>


