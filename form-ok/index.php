<?php include('../config.php'); $back_link='<a href="javascript: history.back(-1);">';
$utm='?utm_source=upsel&utm_medium='.$_SESSION['name'].'&utm_campaign='.$_SESSION['phone'].'&utm_term='.$_COOKIE['last_oid'];

 ?><!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo strip_tags($thanks1) ?></title>
	<meta name="author" content="GreyGler" />
	<?php if ((($upsel_delay!=0) OR ($upsel_delay!="")) AND ($upsel_url!="")) 
			echo('<meta http-equiv="refresh" content="'.$upsel_delay.'; url='.$upsel_url.$utm.'">');
		?>
	<meta name="copyright" content="https://greygler.com" />
	<link rel="shortcut icon" href="config/favicon.png" type="image/png">
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/spacelab/bootstrap.min.css" rel="stylesheet" integrity="sha384-L/tgI3wSsbb3f/nW9V6Yqlaw3Gj7mpE56LWrhew/c8MIhAYWZ/FNirA64AVkB5pI" crossorigin="anonymous">
	 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.34.0/codemirror.css" />
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	 <style> 
	 body {margin-top: 1em; background-image: url(config/images/background.jpg); background-repeat: repeat;}
	 
	     .list_info li span {width: 150px;display: inline-block;font-weight: bold;font-style: normal;}
      .list_info {text-align: left; display: inline-block;list-style: none; margin-top: -10px; margin-bottom: -11px; }
      .list_info li {margin: 11px 0px;font-size: 16px;}
      .success {text-align: center; margin-bottom: 20px;}
			.page-header {margin: 0 !important;}
			
    </style> 
	
	 <script>localStorage.clear();</script>
	 <?php echo base64_decode($head_thanks64) ?>

	 <script>
window.dataLayer = window.dataLayer || []
dataLayer.push({

	'event': 'lead',

  'transactionId': 					'<?= $_COOKIE['last_oid'] ?>', //id транзакции
   'transactionAffiliation': 	'<?= $_SERVER['SERVER_NAME'] ?>'	, //название магазина
   'transactionTotal': 				 '<?= number_format($_SESSION['price']+$_SESSION['price2'], 2, '.', '') ?>', //цена покупки
   'transactionProducts': [{
       'sku': 			'<?= $_SESSION['prod_id'] ?>', //артикул товара (нужно присвоить артикул товару, но визуально можно его не показывать)
       'name': 			'<?= $_SESSION['prodname'] ?>', //название товара - кавычки нужно убрать, если они есть
       'category': 	'Кухонные аксесуары', //категория товара
       'price': 		'<?= number_format($_SESSION['price'], 2, '.', '') ?>', //цена товара
       'quantity': 	 '1' // количество товаров
   } <? if ($_SESSION['prod_id2']!=0) { ?>, {
       'sku': 			'<?= $_SESSION['prod_id2'] ?>', //артикул товара (нужно присвоить артикул товару, но визуально можно его не показывать)
       'name': 			'<?= $_SESSION['prodname2'] ?>', //название товара - кавычки нужно убрать, если они есть
       'category': 	'Кухонные аксесуары', //категория товара
       'price': 		'<?= number_format($_SESSION['price2'], 2, '.', '') ?>', //цена товара
       'quantity': 	 '1' // количество товаров
   }
<? } ?>
   ]
});
</script>


</head>
<body >
<?php echo base64_decode($body_thanks64) ?>
<div class="container"> 
<div class="text-center">
<i class="fa fa-check fa-5x text-success" aria-hidden="true"></i>
<div class="page-header">
 <h1 class="text-success"><strong><?php echo $thanks1 ?></strong> </h1>
 </div></div>
 
 
 
  <h4 class="text-center"><?php echo $thanks2 ?></h4>
   <div class="success">
        <ul class="list_info">
          <?php if ($_SESSION['name']!="") { ?><li><span>Ім'я: </span><span ><?php echo $_SESSION['name'] ?></span></li><?php } ?>
          <?php if ($_SESSION['phone']!="") { ?><li><span>Телефон: </span><span><?php echo $_SESSION['phone'] ?></span></li><?php } ?>
        </ul>
        <br/><span id="submit"></span>
      </div>
 
 

  
  <p class="text-center"><?php echo str_ireplace("%back_link%", $back_link, $thanks3); ?></a></p>

 <?php if ($upsel){
	echo ("<hr width: 40%> <h3 id=\"upsel\" class=\"text-danger success\">{$upsel_title}</h3>");
	echo ('<center><a href="'.$upsel_url.$utm.'"><img class="img-responsive" src="config/upsel_img/'.$upsel_pic.'" height="'.$upsel_pic_h.'"></a></center>');
	echo ("<h3 class=\" text-danger success\">");
	if ($upsel_url!="") echo ("<a href=\"{$upsel_url}{$utm}\">");
	echo $upsel_url_title;
	if ($upsel_url!="") echo ("</a>");
	echo ("</h3>"); ?>
	<script>$(document).ready(function(){setTimeout(function() { $('html, body').animate({ scrollTop: $('#upsel').offset().top }, 500); }, 2000);});</script>
  <?php     
}
?>

</div>
<?php echo base64_decode($body2_thanks64) ?>
	
</body>
</html>