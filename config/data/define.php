<?php  
if (stripos($_SERVER['PHP_SELF'], "index"))
	{	define('YEAR',date("Y"));
		define('TODAY', date("d.m.Y"));
		$period_cookie = 2592000; // 30 дней (2592000 секунд)
		require_once("config/include/session.php");
		require_once("config/class/functions.class.php");
		$host_path=str_ireplace('index.php','', $_SERVER['PHP_SELF']);
		$domen=str_ireplace("www.", "", $_SERVER['HTTP_HOST']);
				$scheme=Config::scheme();

		$remote_addr=Config::GetRealIp();
		$lang=Config::lang();
		$host=$domen.$host_path;
		$url="{$scheme}://{$domen}";
		$server="{$scheme}://{$host}";
		$server_request_uri="{$scheme}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$user_agent=$_SERVER['HTTP_USER_AGENT'];
		$_SESSION['serv']=$server;
	}


