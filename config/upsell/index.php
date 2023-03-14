<?php
require_once(__DIR__ . '/lib.php');

$data = file_get_contents(__DIR__ . '/text_blocks.data');
$text_blocks = unserialize_text_blocks($data);

$data = file_get_contents(__DIR__ . '/products.data');
$products = unserialize_products($data);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Спецпредложение от нашего интернет-магазина, товары по супер цене!</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link type="image/x-icon" rel="icon" href="favicon.ico">
		<link type="image/x-icon" rel="shortcut icon" href="favicon.ico">
		<link type="text/css" rel="stylesheet" href="css/upsell.css">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/upsell.js"></script>
	<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '296404247633284');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=296404247633284&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->


<script>
  fbq('track', 'Purchase');
</script>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127032334-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-127032334-1');
</script>
	</head>
	<body class="man">

		<div class="section block-1">
			<div class="wrap">
				<img src="img/call-girl.png">
				<div class="top-title">
					<h2><?php echo $text_blocks['block1']; ?></h2>
					<div><?php echo $text_blocks['block2']; ?></div>
					<p><b style="color:black"><?php echo $text_blocks['block3']; ?></b></p>
				</div>
			</div>
		</div>
		<div class="section block-2">
			<div class="wrap">
				<h1><?php echo $text_blocks['block4']; ?></h1>
				<p><?php echo $text_blocks['block5']; ?></p>
			</div>
		</div>
		<center class="timer">
			<script src="megatimer/s/4cfe04346a315ffcfcc46c483227a5e6.js"></script>
		</center>
		<div class="section block-3">
			<div class="wrap">
			<?php foreach($products as $product_id => $product): ?>
				<div class="tov-item tov-rate-1 clearfix">
					<span class="tov-item-sale"><?php echo $product['discount']; ?></span>
					<div class="tov-left-cont">
						<div class="tov-gal clearfix">
							<div class="tov-gal-big">
								<img src="<?php echo $product['image1'] ? $product['image1'] : ($product['image2'] ? $product['image2'] : ($product['image3'] ? $product['image3'] : ($product['image4'] ? $product['image4'] : ($product['image5'] ? $product['image5'] : '')))) ?>" class="image<?php echo $product_id; ?>">
							</div>
							<div class="tov-gal-list">
							<?php $active_class = 'active '; ?>
							<?php if($product['image1'] != ''): ?>
								<span class="<?php echo $active_class; ?>animate" data-target=".image<?php echo $product_id; ?>"><img src="<?php echo $product['image1']; ?>"></span>
								<?php $active_class = ''; ?>
							<?php endif; ?>
							<?php if($product['image2'] != ''): ?>
								<span class="<?php echo $active_class; ?>animate" data-target=".image<?php echo $product_id; ?>"><img src="<?php echo $product['image2']; ?>"></span>
								<?php $active_class = ''; ?>
							<?php endif; ?>
							<?php if($product['image3'] != ''): ?>
								<span class="<?php echo $active_class; ?>animate" data-target=".image<?php echo $product_id; ?>"><img src="<?php echo $product['image3']; ?>"></span>
								<?php $active_class = ''; ?>
							<?php endif; ?>
							<?php if($product['image4'] != ''): ?>
								<span class="<?php echo $active_class; ?>animate" data-target=".image<?php echo $product_id; ?>"><img src="<?php echo $product['image4']; ?>"></span>
								<?php $active_class = ''; ?>
							<?php endif; ?>
							<?php if($product['image5'] != ''): ?>
								<span class="<?php echo $active_class; ?>animate" data-target=".image<?php echo $product_id; ?>"><img src="<?php echo $product['image5']; ?>"></span>
								<?php $active_class = ''; ?>
							<?php endif; ?>
							</div>
						</div>
						<!--<ul class="tov-adv clearfix">
							<li class="hint hint--top  hint--info" data-hint="Гарантия возврата 14 дней"></li>
							<li class="hint hint--top  hint--info" data-hint="Доставка в течение 5-10 рабочих дней"></li>
							<li class="hint hint--top  hint--info" data-hint="Оплата товара при получении"></li>
						</ul>-->
					</div>
					<div class="tov-info">
						<h3><?php echo $product['name']; ?></h3>
						<div class="tov-info-rate"></div>
						<div class="tov-info-cost">
							<span class="old-cost"><?php echo $product['old_price']; ?></span>
							<span class="new-cost"><?php echo $product['price']; ?></span>
						</div>
						<p class="tov-info-text"></p>
						<p><b><?php echo $product['description']; ?></b></p>
						<p>&nbsp;</p>
						<button class="tov-button animate" data-name="<?php echo $_REQUEST['name'];?>" data-phone="<?php echo $_REQUEST['phone'];?>" data-item="<?php echo $product['name']; ?>">Добавить к заказу</button>
					</div>
				</div>
			<?php endforeach; ?>
				<center>
					&larr; <a class="back" href="../">Вернуться обратно на сайт</a>
				</center>
			</div>
		</div>
		<div class="section footer">
			<div class="wrap clearfix">
				<div class="left clearfix foot-logo">
					<p><?php echo $text_blocks['block6']; ?></p>
				</div>
				<div class="right"><p><?php echo $text_blocks['block7']; ?></p></div>
			</div>
		</div>
	</body>
</html>