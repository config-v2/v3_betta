 <?
 $data = array(

    'uid' => $uid,
    'key' => $idu,
    'visitor_id' => $_SESSION['v_id'],
    'prod_id' => $prod_id,
      'price'  => $price_new,
      'quantity' => 1,
    'name'    => $name,             // покупатель (Ф.И.О)
    'phone'   => $phone ,           // телефон
    'email' => $email_client,
    'adress' => $adress_client,
    'city' => $city_client,
    'zipcode' => $zipcode_client,
    'comment' => $commentform
  

);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "{$crm_url}/api/add_order",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($data),
  CURLOPT_HTTPHEADER => array(
    "Accept: application/json",
    "Content-Type: application/json",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
 //print_r($response);

$logfile = fopen("log.txt", "a+");
fwrite($logfile, $response);
fclose($logfile);

$info=json_decode($response,true);
$crm_tele=  "<b>HandyCRM:</b> {$info['crm']}";
 ?>