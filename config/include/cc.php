<?





$cart=array();

$cart[]=array(
    'id'          => $prod_id,           // Id товара
  //  'sub_id'      => $sub_id,       // ID подтипа товара (если есть)
    'product'     => $prodname,      // Название
  //  'sub_product' => $sub_product,  // Название подтипа товара (если есть)
    'price'       => $price,
    'qty'         => 1        // Кол-во
  );

if ($prod_id2!=0)
{
    $cart[]=array(
    'id'          => $prod_id2,           // Id товара
  //  'sub_id'      => $sub_id,       // ID подтипа товара (если есть)
    'product'     => $prodname2,      // Название
  //  'sub_product' => $sub_product,  // Название подтипа товара (если есть)
    'price'       => $price2,
    'qty'         => 1        // Кол-во
  );
}


/*
 $data = array(

     'ChatID'        => $ChatID,              // Управляющий Чат ID
    'managerID'     => $managerID,               // Менеджер ID
    'managerName'   => $managerName,                // Имя менеджера
    'bayer_name'    => $name,                     // покупатель (Ф.И.О)
    'phone'         => $phone,                    // телефон
    'email'         => $email_client,             // E-mail клиента
    'comment'       => $commentform,              // Комментарий
    'server'        => $_SERVER,                  // Сервер
    'price'       => "{$price_new} {$valuta}",  // Цена - валюта
    'product'       => $product,                  // Название товара
    'product_id'    => 7,                         // ID продута
    'longtime' => (time()-$_SESSION['start_time']),// Время на сайте, сек
    'site'          => $_SESSION['serv'],         // Сервер
    'utm'           => $_SESSION['utms'],         // УТМ-метки
    'ref'           => $_SESSION['referer']       // Реферер

);



*/

 $data = array(

    

    'ChatID'          => $ChatID,                   // * Управляющий Чат ID
    'managerID'       => $managerID,                // * Менеджер ID
    'managerName'     => $managerName,              // * Имя менеджера
    'country'         => 'UA',                      // * Страна
    'bayer_name'      => $name,                     // * покупатель (Ф.И.О)
    'phone'           => $phone,                    // * телефон
    'email'           => $email_client,             // E-mail клиента
    'comment'         => $commentform,              // Комментарий

    'city'            => $city,                     // Город
    'address'         => $address,                  // Адрес
    'zip'             => $zip,                      // Индекс


    'Cart'            => $cart,                     // Корзина с товарами 
    'currency'        => 'грн',                       // Валюта заказа
    'OrderID'         => $OrderID,                  // * По умолчанию - 0. Необходимо для допродажи или коррекции заказа
    'server'          => $_SERVER,                  // * Системная информация
    'session'         => $_SESSION,                 // * Данные точки входа

    'count_oid'       => $count_oid,                // К-во заказов за последние 30 дней, рекомендуемое поле
    'last_oid'        => $last_oid,                 // ID последнего заказа, рекомендуемое поле
    'spam'            => $spam,                     // Количество зафиксированного СПАМа
    'mat'            => $mat,                      // Количество зафиксированного Мата
    
    'deliveryCompany' => '1',                       // ID способа доставки, не обязательное поле
    'mess'            => 'Новый заказ',             // Текст уведомления, не обязательное поле
    'keyboard'        => '1',                       // Нужна ли клавиатура для КЦ. По умолчанию - 1 (ДА)
                                                    // Автоматически отключаются "напоминалки"
    
 
  

  

);

 $log_text=""; $error=""; $mat=0;

 if (isset($_COOKIE['count_oid']))
 {
    
    $data['count_oid'] = $_COOKIE['count_oid'];
    $data['last_oid'] = $_COOKIE['last_oid'];
   

 } else {

    $data['count_oid'] = 0;
    $data['last_oid'] = 0;
}
   

 if (isset($_COOKIE['spam'])) { $data['spam'] = $_COOKIE['spam']; } else { $data['spam'] = 0; }
 if (isset($_COOKIE['mat'])) { $data['mat'] = $_COOKIE['mat']; } else { $data['mat'] = 0; }
 


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://sv-bot.svdirect.eu/api/add_order",
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

$out=json_decode($response,true);




if ($out['status']=='Ok') {
    setcookie("last_oid",$out['id_order'],time()+(60*60*24*31),'/');
    if (isset($_COOKIE['count_oid'])) {$count_oid=$_COOKIE['count_oid']; $count_oid++; } else {$count_oid=1;}
    setcookie("count_oid",$count_oid,time()+(60*60*24*31),'/');

   
        if (isset($_COOKIE['spam'])) { $spam=$_COOKIE['spam'];
                 if ($out['spam']==1) {  $spam++; }  }

             else {  if ($out['spam']==1) {  $spam=1; }  else {$spam=0;}  }

             setcookie("spam",$spam,time()+(60*60*24*31),'/');

        if (isset($_COOKIE['mat'])) { $mat=$_COOKIE['mat'];

            if ($out['mat']==1) {  $mat++; }  }
             
     else { if ($out['mat']==1) { $mat=1; } else {$mat=0;} }


             setcookie("mat",$mat,time()+(60*60*24*31),'/');
       
      
} else { $err.="\nERROR:\n".print_r($out,true); }

curl_close($curl);

 $log_text = date("d/m/Y H:i:s")."\nData:".print_r($data,true)."\nOut:".print_r($out,true)."\nErr: {$err}\n\n";
 if ($out['status']=='Ok') { $log_text.="\nКуки: {$_COOKIE['last_oid']} :: {$_COOKIE['count_oid']} - ок\n\n"; }

file_put_contents('log_cc.txt', $log_text, FILE_APPEND); 

if (isset($err) AND ($err!=''))
{
   file_put_contents('error_cc.txt', date("d/m/Y H:i:s")."\nData:".print_r($data,true)."\nOut:".print_r($out,true)."\nErr: {$err}\n\n", FILE_APPEND);  
}
 
 ?>