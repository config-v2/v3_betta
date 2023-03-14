<?php 
class Lands{
	
	public function currency($country)
	{
		switch ($country) {
		case 'UA': 	$currency='UAH';	break;
		case 'RU': 	$currency='RUB';	break;
		case 'BY': 	$currency='BYN';	break;
		case 'KZ': 	$currency='KZT';	break;
		
		default: { $currency='RUB';	}
		}
		return $currency;
	}
	
	public function og($price, $title, $desc, $img, $country, $fb_app_id )
	{
		
		$server=$_SESSION['serv']; $size_pic=getimagesize($server.$img);
		?>
		<!-- OG-теги -->
	<meta name="title" content="<?php echo  $title ?>">	
	<meta property="og:title" content="<?php echo  $title ?>" />
	<meta property="og:description" content="<?php echo  $desc ?>" />
	
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php echo  $server ?>" />
	<meta property="og:image" content="<?php echo  $server ?><?php echo  $img ?>" />
	<meta property="og:image:width" content="<?php echo  $size_pic['0']?>" />
	<meta property="og:image:height" content="<?php echo  $size_pic['1']?>" />
	
	<meta property="fb:app_id" content="<?php echo $fb_app_id?>"/>
	
	<!-- Для товара  -->
	<meta property="og:price:amount" content="<?php echo  $price ?>">
	<meta property="og:price:currency" content="<?php echo  Lands::currency($country) ?>">
	
	<!-- Twitter -->
	<meta name="twitter:url" content="<?php echo  $server ?>" />
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="<?php echo  $title ?>">
	<meta name="twitter:description" content="<?php echo  $desc ?>">
	<meta name="twitter:image" content="<?php echo  $server ?><?php echo  $img ?>" />
	<meta name="twitter:image:width" content="<?php echo  $size_pic['0']?>">
	<meta name="twitter:image:height" content="<?php echo  $size_pic['1']?>">
	
	<meta itemprop="name" content="<?php echo  $title ?>"/>
	<meta itemprop="description" content="<?php echo  $desc ?>"/>
	<meta itemprop="url" content="<?php echo  $server ?>"/>
	<meta itemprop="image" content="<?php echo  $server ?><?php echo  $img ?>"/>
	
	<?php 
	} 
	
	
	
	
	public function head($head_index64)
	{
		?><!-- Head Index -->
		<?
		if (file_exists("config/data/value.php")) include("config/data/value.php");
		if ($og_tag=='1') lands::og($price_new, $og_title, $og_desc, $og_pic, $country_script, $fb_app_id );
		?>
		<style>
		.video-container {margin: -1px auto 0;background-color: #000;overflow: hidden;position: relative;}
		 @media (max-width: 767px) { 
			.video-container {width: 320px;height: 157px;margin-bottom: 15px;}
		 }
		@media (min-width: 768px) {.video-container {width: 480px;height: 270px;margin: 15px;}}
		@media (min-width: 992px) {.video-container {width: 480px;height: 270px;margin: 15px;}} 
		</style>
	
		
		<?php echo(base64_decode($head_index64)); ?>
		<!-- /Head Index -->
		<?php
	}
	
	public function body($body_index64)
	{
		?>
		
		
		<!-- Body Index -->
		<?php  echo(base64_decode($body_index64)); ?>
		<!-- /Body Index -->
		<?php
	}
	
	
	
	public function form($formname)
	{
		echo('<input type="hidden" name="formname" value="'.$formname.'">');
		
	}
	
	
	
	
    
	
	
	public function footer($body2_index64, $polit="", $mask_phone='-',$crm="")
	{
		?>
		<!-- Footer index -->
		<?php 
			if ($crm == "handycrm")	
			{ ?>
			
			<script>var body = document.getElementsByTagName("body");body[0].innerHTML += "<img width='1' style='position:absolute;top:-10px;width:1px;display: none;' src='scan/?g="+encodeURIComponent(window.location.search)+"&tz="+(new Date()).getTimezoneOffset()+"&x="+screen.width+"&y="+screen.height+"&c="+screen.colorDepth+"&ref="+document.referrer+"'>";</script><noscript><img width='1' style='position:absolute;top:-10px;width:1px;display: none;' src="scan/?g=<?= $_SERVER['QUERY_STRING'] ?>&ref=<?= $_SERVER['HTTP_REFERER']?>"></noscript>
				
			<?php }			
		
		
		if ($mask_phone!="-"){ ?><link rel="preload" href="config/js/jquery.maskedinput.js" as="script"><script src="config/js/jquery.maskedinput.js"></script><script src="config/js/mask<?php echo  $mask_phone ?>.js"></script><? } ?><script src="config/js/conf.js"></script><link rel="stylesheet" href="config/css/conf.css">
		
	
<div class="hidden-conf">
            <div class="conf-overlay close-conf"></div>
            <div class="conf-info">
                <div class="conf-head">Политика конфиденциальности</div>
				<?php echo  $polit ?>
				<div class="close-conf closeconf-but"></div>
            </div>
        </div>
		<!-- Body Index2 -->
<?php echo(base64_decode($body2_index64)); ?>
		<!-- Конфигуратор Версия 2.4, http://config-v2.github.io -->
		<?php 
	}
	
	public function politics($color=""){
	
	?>
		
		
	  <div style="text-align: center;<?php  if ($color!='') echo ("color: {$color};");?>;">
	  <div class="confident-link">Политика конфиденциальности</div></div>




		
	<?php 	
		
	}
	public function link_phone($phone, $class="")
	{
		if ($class!="") $classinc='class="'.$class.'"'; 
		echo('<a '.$classinc.' href="tel:'.preg_replace('![^0-9]+!', '', $phone).'">'.$phone."</a>");
	}
	
	public function link_email($contact_email,$class="")
	{
		if ($class!="") $classinc='class="'.$class.'"';
		echo('<a '.$classinc.' href="mailto:'.$contact_email.'">'.$contact_email."</a>");
	}
	
	public function seller($color=''){
		if (file_exists("config/data/value.php")) include("config/data/value.php"); ?>
		<address style="text-align: center;<?php  if ($color!='') echo ("color: {$color};");?>">   
		<?php  	if ($seller!="") echo ("<strong>{$seller}</strong>"); 
			if ($seller_adress!="") echo ("<br>".$seller_adress); 
			if ($contact_phone1!="") { echo('<br>'); lands::link_phone($contact_phone1); } 
			if ($contact_phone2!="") { echo('&nbsp;|&nbsp;'); lands::link_phone($contact_phone2); } 
			if ($contact_phone3!="") { echo('&nbsp;|&nbsp;'); lands::link_phone($contact_phone3); } 
			if ($contact_email!="")  { echo('<br>'); lands::link_email($contact_email); } 
		?>
		</address>
	
			
<?php  }

	

 } ?>