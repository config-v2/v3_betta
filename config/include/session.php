<?php 
if($_GET){
    setcookie("utm_source",$_GET['utm_source'],time()+$period_cookie);
    setcookie("utm_medium",$_GET['utm_medium'],time()+$period_cookie);
    setcookie("utm_term",$_GET['utm_term'],time()+$period_cookie);
    setcookie("utm_content",$_GET['utm_content'],time()+$period_cookie);
    setcookie("utm_campaign",$_GET['utm_campaign'],time()+$period_cookie);
    setcookie("gclid",$_GET['gclid'],time()+$period_cookie);
    setcookie("fbclid",$_GET['fbclid'],time()+$period_cookie);
}

if(!isset($_SESSION['utms'])) {
    $_SESSION['utms'] = array();
    $_SESSION['utms']['utm_source'] = '';
    $_SESSION['utms']['utm_medium'] = '';
    $_SESSION['utms']['utm_term'] = '';
    $_SESSION['utms']['utm_content'] = '';
    $_SESSION['utms']['utm_campaign'] = '';
    $_SESSION['utms']['gclid'] = '';
    $_SESSION['utms']['fbclid'] = '';
}
$_SESSION['utms']['utm_source'] = $_GET['utm_source'] ? $_GET['utm_source'] : $_COOKIE['utm_source'];
$_SESSION['utms']['utm_medium'] = $_GET['utm_medium'] ? $_GET['utm_medium'] : $_COOKIE['utm_medium'];
$_SESSION['utms']['utm_term'] = $_GET['utm_term'] ? $_GET['utm_term'] : $_COOKIE['utm_term'];
$_SESSION['utms']['utm_content'] = $_GET['utm_content'] ? $_GET['utm_content'] : $_COOKIE['utm_content'];
$_SESSION['utms']['utm_campaign'] = $_GET['utm_campaign'] ? $_GET['utm_campaign'] : $_COOKIE['utm_campaign'];
$_SESSION['utms']['gclid'] = $_GET['gclid'] ? $_GET['gclid'] : $_COOKIE['gclid'];
$_SESSION['utms']['fbclid'] = $_GET['fbclid'] ? $_GET['fbclid'] : $_COOKIE['fbclid'];

$_SESSION['referer']=$_SERVER['HTTP_REFERER']; 
 $_SESSION['start_time']=time(); 
 file_put_contents('log.txt', date("d/m/Y H:i:s")."\n\n* GET:".json_encode($_GET, JSON_UNESCAPED_UNICODE)."\n\n* SESSION:".json_encode($_SESSION, JSON_UNESCAPED_UNICODE)."\n\n\n", FILE_APPEND); 
?>