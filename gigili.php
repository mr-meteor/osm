<?php
$auth = 1;
$name='admin';
$pass='123';
if($auth == 1) {
	if (isset($_GET["user"]) && isset($_GET["pass"])){
	   if ($_GET["user"]!==$name && $_GET["pass"]!==$pass){
		   header('WWW-Authenticate: Basic realm="Password Protected"');
		   header('HTTP/1.0 401 Unauthorized');
		   exit("<b>Incorect password - Try again or contact server administrator.</b>");
	   }
	}elseif (!isset($_SERVER['PHP_AUTH_USER'])){
	   if ($_SERVER['PHP_AUTH_USER']!==$name || $_SERVER['PHP_AUTH_PW']!==$pass){
		   header('WWW-Authenticate: Basic realm="Password Protected"');
		   header('HTTP/1.0 401 Unauthorized');
		   exit("<b>Incorect password - Try again or contact server administrator.</b>");
	   }
	}
}
// Turn off all error reporting
error_reporting(0);
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
$options = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Accept: text/html, */*\r\n" .
              "Referer: http://maps.google.com/\r\n" .
              "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)".
              "Connection: Close\r\n" .
              "Cookie: \320\006\r\n"
  )
);
$context = stream_context_create($options);
$_GET['y'] = str_replace(".png", "", $_GET['y']);
$s = array("karaj", "fardis", "iran", "tehran", "kerman", "Galile", "Ga", "texas", "qom");
$rand_keys = array_rand($s, 1);
if (isset($_GET["t"])){
	if ($_GET["t"]=="s"){
		if ($_GET["ps"]=="2"){
			$url = array("http://mt3.google.com/vt/lyrs=s&hl=x-local&src=app&s=", "http://mt2.google.com/vt/lyrs=s&hl=x-local&src=app&s=", "http://mt1.google.com/vt/lyrs=s&hl=x-local&src=app&s=", "http://mt0.google.com/vt/lyrs=s&hl=x-local&src=app&s=");
		}else{
			$url = array("http://khm3.google.com/kh/v=746&s=", "http://khm2.google.com/kh/v=746&s=", "http://khm1.google.com/kh/v=746&s=", "http://khm0.google.com/kh/v=746&s=");
		}
	}elseif ($_GET["t"]=="m"){
		$url = array("http://mt0.google.com/vt/lyrs=m&hl=x-local&src=app&s=", "http://mt1.google.com/vt/lyrs=m&hl=x-local&src=app&s=", "http://mt2.google.com/vt/lyrs=m&hl=x-local&src=app&s=", "http://mt3.google.com/vt/lyrs=m&hl=x-local&src=app&s=" );
	}elseif ($_GET["t"]=="h"){
		$url = array("http://mt0.google.com/vt/lbw/lyrs=y&hl=x-local&src=app&s=", "http://mt1.google.com/vt/lbw/lyrs=y&hl=x-local&src=app&s=", "http://mt2.google.com/vt/lbw/lyrs=y&hl=x-local&src=app&s=", "http://mt3.google.com/vt/lbw/lyrs=y&hl=x-local&src=app&s=" );
	}
}else{
	$url = array("http://mt0.google.com/vt/lyrs=s&hl=x-local&src=app&s=", "http://khm3.google.com/kh/v=746&s=", "http://khm2.google.com/kh/v=746&s=", "http://khm1.google.com/kh/v=746&s=", "http://khm0.google.com/kh/v=746&s=");
}
$rand_keys2 = array_rand($url, 1);
$url = $url[$rand_keys2].$s[$rand_keys].'&x='.$_GET['x'].'&y='.$_GET['y'].'&z='.$_GET['z'];
if (($fp = fopen($url, 'rb', false, $context))!==false) {
	// var_dump(stream_get_meta_data($fp));
	$content= stream_get_contents($fp);
	if($content!=""){
		header("Content-Type: image/jpeg");
		echo $content;
		exit();
	}else{
		header('HTTP/1.0 403 Forbidden'); 
		die('<br>Error: Empty response ignored.<br>'.var_dump(stream_get_meta_data($fp)).'<br>'.$url);
	}
}else{
	header('HTTP/1.0 403 Forbidden'); 
    die('<br>An error happened loading tile from server.<br>'.$url);
}
?>