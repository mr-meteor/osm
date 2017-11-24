<?php
// Script Configuration section:
$url = "https://www.terraserver.com/viewers/wms?SERVICE=WMS&REQUEST=GetMap&VERSION=1.1.1&LAYERS=DigitalGlobe%3AImagery&STYLES=&FORMAT=image%2Fpng&TRANSPARENT=true&HEIGHT=256&WIDTH=256&REUSETILES=true&SHOWTHERASTERRETURNED=true&BBOX=undefined&COVERAGE_CQL_FILTER=featureId%3D%27e7fa6069aa3dd0f42f4639f80ddac1fa%27&SRS=EPSG%3A3857&BBOX=";
$cookie = "_ga=GA1.2.452612506.1506348656; __hstc=176918458.c81a8251e32d61018ddcef05bfc28dbd.1506348663309.1506698986162.1506706178991.15; hubspotutk=c81a8251e32d61018ddcef05bfc28dbd; anonymous_data=SitEdUF4RUk1MHc0cjBKR1NFNjhJZz09LS1IYjBCWFp6UEppT05HeGZySWpLSGlRPT0%3D--17ab05407599e7f9e0cda01e724dfbe98b71c574; _terraserver_session=c1pRN3BJbTd3V3pWRDVkY0tVWGRKeGJkUzJRUDNBRlFDcG04Y1JJRmhxbWFkcGFRYzdNb0dCK3lDRjhlRXNINlhoS1VWWEQ4Qkd0VXdMS05iMU5oNklqZEhTSzdiNTNDRTd2b1JNbTNwbzh0dE4wdkZRdEJTaERFSGVzK0V6N3U4K1YvczY1N285enJVSVNucnFIYS8yV2p4cnF6d0s0aEI1Q1ByNEdjL0hRcnZGZEJIY2lscktBcDk0KytGcW9uRTdlOFRGbnZzVmF6OHQzLzNEZEZ5RjJzWGljYitNM2VubWM3WHEvaVZWRzJZNnZjN1JsWlhJSHhVU3A2NFVoM0h3WTUrNFBFbExZd3QrVy9EVko3VXVnY1NYdXNXamxJQWJXdC9mMFh1eGlCVlNsWUlnMDBkbDA2QmxOVDIzYTdQaDZyOE9lZlh4eDJzYnpxV3RieU8rZmVEcUhuc1djK2UwcmlvbFIvRFZFMnBFVTh2V3FidGRZWndvaHQ2SXhxS1NabFBaUGlNdnhtMHBEZVJGUXVEZjVjS0grTEYrU0ZlWGxkWHNhd253STFrNDhDOGpNcVBFK011TGYzbWNmQmxZeGNGUW14bXowOEt1QURFdUUwZlRkd08ySVZJRzJraGFqcEVRL0h4Z3lwMzg0Y2lkbjhOeGNLR3FYYVJUdkI5UHFBdmZtak1lcFJHdEswZW5FakxLN09VeG8yQ0FSTWFTUnVLbHp4WUcxMTc5U0tnUTdEdStSVzVzZHBTTllYNGhKWWJxSUQxaStmL2syc0RxMW1qcE5lVHU4WHZvWHkwT0lEb05rK2w0UT0tLUk1MDh4WUJabUl2SkVSOHo0UEtYaGc9PQ%3D%3D--68f2e90fb3d4140826286124351b2e3f9b90b03b; _gid=GA1.2.195603912.1508614146; image_sessions=Z05IWlNFMzQxVFRVOWZNMS9hTmdzUT09LS1CdmpsMGxWOWlOVDNscmEyd2dNb2VnPT0%3D--cc8916b10cbef4618a4bbb40ea7ae1745a2a47ad; wms_image_sessions=SHJidHRwSG1SeUdWMktpVjFERk1CQT09LS1FbmlQR2o1Q3lFbzBDaG5TY25nemNRPT0%3D--189a18b95faffa230a4c54ee9b209fba5ea3fb8a; _gat=1; search_text=Latitude: 35.84997 Longitude: 50.90942; featureid=e7fa6069aa3dd0f42f4639f80ddac1fa; 50.905559062957764,35.84762184008005,50.913283824920654,35.85231783882317; searchLat=35.84997; searchLng=50.90942; zoomLevel=17";
$name='admin';
$pass='123456';
$auth = 1;
// Thats it,Dont edit below this line. Happy mapping. ==================================================================================================================================================================
if($auth == 1) {
	if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER']!==$name || $_SERVER['PHP_AUTH_PW']!==$pass){
	   header('WWW-Authenticate: Basic realm="Password Protected"');
	   header('HTTP/1.0 401 Unauthorized');
	   exit("<b>Incorect password - Try again or contact server administrator.</b>");
	}
}
// error_reporting(0) ;// Turn off all error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
$options = array(
  'http'=>array(
    'method'=>"GET",
	// 'ignore_errors'=>'1',
	// 'max_redirects' => '0',
    'header'=>"User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:55.0) Gecko/20100101 Firefox/55.0\r\n".
			  "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n" .
			  "Accept-language: en-US,en;q=0.5\r\n" .
              "Accept-Encoding: gzip, deflate, br\r\n" .
              "Referer: https://www.terraserver.com/view?utf8=%E2%9C%93&search_text=&searchLat=&searchLng=&lat=37.46663&lng=49.47225&bbox=&center=\r\n" .//good
			  "Cookie: ".$cookie."\r\n".
              "Connection: keep-alive\r\n" .
			  "Upgrade-Insecure-Requests: 1\r\n" .
              'If-None-Match: W/"3252a1bc79d2cf7ca1790f3e331f5db0"\r\n'
  )
);
$context = stream_context_create($options);
$_GET['y'] = str_replace(".png", "", $_GET['y']);
$zoom = htmlspecialchars($_GET["zoom"]);
$x = htmlspecialchars($_GET["x"]);
$y = htmlspecialchars($_GET["y"]);
//explanation: https://gist.github.com/tmcw/4954720
//				https://gist.github.com/yarl/8224075
$y = pow(2, $zoom)-$y-1;
//source: https://github.com/timwaters/whoots/blob/master/whoots.rb
function get_tile_bbox($x,$y,$z) {
  $merc1 = get_merc_coords($x * 256, $y * 256, $z);
  $merc2 = get_merc_coords(($x + 1) * 256, ($y + 1) * 256, $z);
  $min_x = $merc1['merc_x']; $min_y = $merc1['merc_y'];
  $max_x = $merc2['merc_x']; $max_y = $merc2['merc_y'];
  return $min_x.",".$min_y.",".$max_x.",".$max_y;
}
function get_merc_coords($x,$y,$z) {
  $resolution = (2 * pi() * 6378137 / 256) / (pow(2,$z));
  $merc_x = ($x * $resolution - 2 * pi() * 6378137 / 2.0);
  $merc_y = ($y * $resolution - 2 * pi() * 6378137 / 2.0);
  return compact('merc_x', 'merc_y');
}
$bbox = get_tile_bbox($x,$y,$zoom);
$url=$url.$bbox;
// echo $url."<br>";
// echo $bbox."<br>";
// echo "<br><br>";
if (($fp = fopen($url, 'rb', false, $context))!==false) {
	// var_dump(stream_get_meta_data($fp));
	$content= stream_get_contents($fp);
	if($content!=""){
		header("Content-Type: image/png");
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