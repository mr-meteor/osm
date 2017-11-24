<?php
$options = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:55.0) Gecko/20100101 Firefox/55.0\r\n".
			  "Accept: */*\r\n" .
			  "Accept-Language: en-US,en;q=0.5\r\n" .
			  "Accept-Encoding: gzip, deflate\r\n" .
              "Referer: http://map.karaj.ir/\r\n" .
              "Cookie: PHPSESSID=k7qc39nktqe8jqagf77r1nnsu2\r\n" .
              "Connection: keep-alive\r\n"
			  )
);
$context = stream_context_create($options);
$_GET['y'] = str_replace(".png", "", $_GET['y']);
// if ($_GET["z"] == "15"){
	// $url = "http://map.karaj.ir/tiles/gtt/!".substr(base64_encode($_GET['z']."/".$_GET['x']."/".(string)((int)$_GET['y']+1).'.png?c=!mFyYUs1'),1).".png";
if ($_GET["z"] == "16"){
	$url = "http://map.karaj.ir/tiles/gtt/!".substr(base64_encode($_GET['z']."/".$_GET['x']."/".(string)((int)$_GET['y']+1).'.png?c=!mFyYUs1'),1).".png";
}elseif($_GET["z"] == "17"){
	$url = "http://map.karaj.ir/tiles/gtt/!".substr(base64_encode($_GET['z']."/".$_GET['x']."/".(string)((int)$_GET['y']+1).'.png?c=!mFyYUs1'),1).".png";
}elseif($_GET["z"] == "18"){
	$url = str_replace("QMY","Q!Y",substr(base64_encode($_GET['z']."/".$_GET['x']."/".(string)((int)$_GET['y']+1).'.pngc=!mFyYUs1'),1));
	$url = "http://map.karaj.ir/tiles/gtt/!".str_replace("cQY","c_Y",$url).".png";
}elseif($_GET["z"] == "19"){
	$url = str_replace("QMY","Q!Y",substr(base64_encode($_GET['z']."/".$_GET['x']."/".(string)((int)$_GET['y']+1).'.pngc=!mFyYUs1'),1));
	$url = "http://map.karaj.ir/tiles/gtt/!".str_replace("cQY","c_Y",$url).".png";
}else{
	// $fp = fopen("tile-error.png", 'rb', false, $context);
	// header("Content-Type: image/png");
	// fpassthru($fp);
	// exit();
	header('HTTP/1.0 403 Forbidden');
    die('HTTP/1.0 403 Forbidden');
}

$fp = fopen($url, 'rb', false, $context);
// echo $url;
// echo stream_get_contents($fp);
// if (strpos(stream_get_contents($fp,50), '<b>Warning</b>') !== false) {
    // header('HTTP/1.0 403 Forbidden');
    // die('HTTP/1.0 403 Forbidden');
	// exit();
// }
header("Content-Type: image/png");
fpassthru($fp);
fclose($fp);
exit();
?>