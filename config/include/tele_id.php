<?php  //	Отправка в телеграм


$data_tel = array(
    'id'      		  => $tele_id, // ID в телеграмме
	'mess' 			  => $tele_mess, // Tекст уведомления
    'product'     	  => $product,        // Название продукта
	'price' 		  => "{$price_new} {$valuta}",
	'date'			  => "{$date} {$time} ({$timezone})",
    'bayer_name'      => $name,             // покупатель (Ф.И.О)
    'phone'           => $phone,           // телефон
    'email'           => $email_client,           // электронка
	'longtime'		  => $time_in_land,
	'visit'			  => $visit,
	'lastvisit'		  => $visit_text_tele,
	'comment'         => $mess_tele,    // комментарий
	'crm'        	  => $crm_tele,    // Ответ СРМ
	'device' 		  => $device,
	'os'			  => $os,
	'lang'			  => $lang,
	'browser' 		  => $browser,
	'proxy'			  => $proxy,
    'site'            => str_ireplace('zakaz.php','', $server),  // сайт отправляющий запрос
    'ip'              => $remote_addr,  // IP адрес покупателя
	'host'			  => $remote_host,
	'ref' 			  => $referer, // реферер
    'city'			  => $city, // Город заказчика
	'tz'			  => $timezone_user, // Таймзона посетителя
	'screen'		  => $screen,
    'utm_source'      => $_SESSION['utms']['utm_source'],  // utm_source
    'utm_medium'      => $_SESSION['utms']['utm_medium'],  // utm_medium
    'utm_term'        => $_SESSION['utms']['utm_term'],    // utm_term
    'utm_content'     => $_SESSION['utms']['utm_content'], // utm_content
    'utm_campaign'    => $_SESSION['utms']['utm_campaign'] // utm_campaign
);

// echo("data_tele:");print_r($data_tel);echo("<br>");
// запрос
$curl = curl_init();

curl_setopt_array($curl, array(
 CURLOPT_URL => "http://infotools.top/tbot/coolleadbot/api/json/",
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_ENCODING => "",
 CURLOPT_MAXREDIRS => 10,
 CURLOPT_TIMEOUT => 30,
 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 CURLOPT_CUSTOMREQUEST => "POST",
 CURLOPT_POSTFIELDS => json_encode($data_tel),
 CURLOPT_HTTPHEADER => array(
   "Accept: application/json",
   "Content-Type: application/json",
   "cache-control: no-cache"
 ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
	//echo("tele:");print_r($out_tel);echo("<br>");
