<?php
$version="v1.8.1";
$auth = 1;
$name='shahab0s';
$pass='tdildwmk';
$loggedin=False;
// Turn off all error reporting
error_reporting(0);
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
$baseDir = "scripts"; // http://example.com/$baseDir/5/54/10.png; eg. sub/folder
$cacheDir = "cache";              // http://example.com/$baseDir/$cacheDir/
$errorTile = "./tile-error.png";  // relative to $baseDir
$logging = False;

$cacheHeaderTime = 60*60*24*365; // Browser Header (sec)
$cacheFileTime = 60*60*24*365/4; // max File Age (sec)

$host=$_SERVER['SERVER_NAME'].str_replace("\\","/",dirname($_SERVER['SCRIPT_NAME']))."/";
$host="http".(!empty($_SERVER['HTTPS'])?"s":"")."://".str_replace("//","/",$host);
// echo $host;
// $name.":".$pass."@".
$maptypes = array();
$maptypes['karajrajman']['url'] = $host."karaj.php?z={z}&x={x}&y={y}";
$maptypes['isfahanrajman']['url'] = $host."isfahan.php?z={z}&x={x}&y={y}";
$maptypes['osm']['url'] = "http://{s}.tile.osm.org/{z}/{x}/{y}";
$maptypes['osm']['subdomains'] = "abc";
$maptypes['stamen-watercolor']['url'] = "http://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}";
$maptypes['stamen-watercolor']['subdomains'] = "abcd";

/* +++++++++++++++++++++++++++++++++ */

$requestURI = $_SERVER['REQUEST_URI'];

if(substr($requestURI, 0, 1) == "/") {
  $requestURI = substr($requestURI, 1);
}

$requestURI = str_replace($baseDir."/", "", $requestURI);
// echo $requestURI;
if((isset($_GET['admin'])) && ($_GET['admin'] == "true") || (strpos($requestURI, '?/') !== false)){
	if($auth == 1) {
		if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER']!==$name || $_SERVER['PHP_AUTH_PW']!==$pass){
		   header('WWW-Authenticate: Basic realm="Password Protected"');
		   $loggedin = False;
		}else{
			$loggedin = True;
			$maptypes['teri']['url'] = str_replace("http://","http://".$name.":".$pass."@",$host)."teri.php?zoom={z}&x={x}&y={y}";
			$maptypes['gigilis']['url'] = str_replace("http://","http://".$name.":".$pass."@",$host)."gigili.php?t=s&z={z}&x={x}&y={y}";
			$maptypes['gigilis2']['url'] = str_replace("http://","http://".$name.":".$pass."@",$host)."gigili.php?t=s&ps=2&z={z}&x={x}&y={y}";
			$maptypes['gigilim']['url'] = str_replace("http://","http://".$name.":".$pass."@",$host)."gigili.php?t=m&z={z}&x={x}&y={y}";
			$maptypes['gigilih']['url'] = str_replace("http://","http://".$name.":".$pass."@",$host)."gigili.php?t=h&z={z}&x={x}&y={y}";
			$maptypes['namaasat']['url'] = "http://map.namaa.ir/sat/{z}/{x}/{y}";
			$maptypes['namaamap']['url'] = "http://map.namaa.ir/hybrid/{z}/{x}/{y}";
		}
	}
}
$requestURI = str_replace("?/", "", $requestURI);

if (($requestURI!=="") && ($requestURI != "?admin=true")){
	list($maptype, $zoom, $x, $y) = explode("/", $requestURI);
}else{
	$zoom = '';
	$x = '';
	$y = '';
	$maptype = '';
}
// list($maptype, $zoom, $x, $y) = array_pad(explode("/", $requestURI, 2), 2, $requestURI);
// echo $maptype."<br>";
if($maptype == "" || $zoom == "" || $x == "" || $y == "") {
  if($loggedin==True){
	  // var_dump($maptype);
	  // var_dump($zoom);
	  // var_dump($x);
	  // var_dump($y);
	  die("<br>Wellcome Admin, Correct URL Template is : /{maptype}/{z}/{x}/{y}.png<br><br> 
	  Examples:<br>&emsp;
	  Cache Supported: <br>&emsp;&emsp;
	  TerraServer: ".$host."?/teri/{z}/{x}/{y}.png&emsp;&emsp;;This tile server needs configuration. Edit teri.php file.<br>&emsp;&emsp;
	  GoogleSat: ".$host."?/gigilis/{z}/{x}/{y}.png<br>&emsp;&emsp;
	  GoogleSat2: ".$host."?/gigilis2/{z}/{x}/{y}.png<br>&emsp;&emsp;
	  GoogleMap: ".$host."?/gigilim/{z}/{x}/{y}.png<br>&emsp;&emsp;
	  GoogleHybrid: ".$host."?/gigilih/{z}/{x}/{y}.png<br>&emsp;&emsp;
	  MapnamaSat: ".$host."?/namaasat/{z}/{x}/{y}.jpeg<br>&emsp;&emsp;
	  MapnamaHybrid: ".$host."?/namaamap/{z}/{x}/{y}.jpeg<br>&emsp;&emsp;
	  KarajRajman: ".$host."?/karajrajman/{z}/{x}/{y}.png<br>&emsp;&emsp;
	  IsfahanRajman: ".$host."?/isfahanrajman/{z}/{x}/{y}.png<br><br>&emsp;
	  Without Cache(Direct):<br>&emsp;&emsp;
	  TerraServer: ".$host."teri.php?zoom={z}&x={x}&y={y}.png&emsp;&emsp;;This tile server needs configuration. Edit teri.php file.<br>&emsp;&emsp;
	  GoogleSat: ".$host."gigili.php?t=s&z={z}&x={x}&y={y}.png<br>&emsp;&emsp;
	  GoogleSat2: ".$host."gigili.php?t=s&ps=2&z={z}&x={x}&y={y}.png<br>&emsp;&emsp;
	  GoogleMap: ".$host."gigili.php?t=m&z={z}&x={x}&y={y}.png<br>&emsp;&emsp;
	  GoogleHybrid: ".$host."gigili.php?t=h&z={z}&x={x}&y={y}.png<br>&emsp;&emsp;
	  MapnamaSat: http://map.namaa.ir/sat/{z}/{x}/{y}.jpeg<br>&emsp;&emsp;
	  MapnamaHybrid: http://map.namaa.ir/hybrid/{z}/{x}/{y}.jpeg<br>&emsp;&emsp;
	  KarajRajman: ".$host."karaj.php?z={z}&x={x}&y={y}.png<br>&emsp;&emsp;
	  IsfahanRajman: ".$host."isfahan.php?z={z}&x={x}&y={y}.png<br><br><br>&emsp;
	  <center>© Copyright!! Navid Hosseinzadeh. $version</center>");	  
  }else{
	   exit("<b>You are just allowed to use these tiles only:</b><br>&emsp;
		  Examples:<br>&emsp;
		  Cache Supported: <br>&emsp;&emsp;
		  KarajRajman: ".$host."?/karajrajman/{z}/{x}/{y}.png<br>&emsp;&emsp;
		  IsfahanRajman: ".$host."?/isfahanrajman/{z}/{x}/{y}.png<br><br>&emsp;
		  Without cache(Direct):<br>&emsp;&emsp;
		  KarajRajman: ".$host."karaj.php?z={z}&x={x}&y={y}.png<br>&emsp;&emsp;
		  IsfahanRajman: ".$host."isfahan.php?z={z}&x={x}&y={y}.png<br><br><br>&emsp;
		  <center>© Copyright!! Navid Hosseinzadeh. $version</center>");
  }
}
if($loggedin==False){
	exit("<b>Incorect username or password - Try again or contact server administrator.</b>");
}
if(!array_key_exists($maptype, $maptypes)) {
  var_dump($maptype);
  die("Unknown Maptype");
}

$tileUrl = $maptypes[$maptype]['url']; 


$tileUrl = str_replace("{z}", $zoom, $tileUrl);
$tileUrl = str_replace("{x}", $x, $tileUrl);
$tileUrl = str_replace("{y}", $y, $tileUrl);
if (array_key_exists('subdomains', $maptypes[$maptype])) {
	$tileHostSubdomains = $maptypes[$maptype]['subdomains']; 
	if($tileHostSubdomains) {
	  $tileHostSubdomain = $tileHostSubdomains[rand(0, strlen($tileHostSubdomains)-1)];
	  $tileUrl = str_replace("{s}", $tileHostSubdomain, $tileUrl);
	  // echo $tilUrl;
	}
}

$cacheDir = $cacheDir."/".$maptype;
$cacheTileFile = $cacheDir."/".$zoom."/".$x."/".$y;

if(!$imgData = cacheTile($tileUrl, $cacheTileFile)) {
  logger($tileUrl." using error Tile");
  $imgData = file_get_contents($errorTile);
}

$file_extension = strtolower(substr(strrchr(basename($cacheTileFile),"."),1));

switch( $file_extension ) {
  case "png": $mimetype="image/png"; break;
  case "gif": $mimetype="image/gif"; break;
  case "jpeg":
  case "jpg": $mimetype="image/jpg"; break;
  default:
}


//set last-modified header
// TODO: make $imgData->data and $imgData->lastModified
#header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");

//set expires header
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + ($cacheHeaderTime)));

//set etag-header
header("Etag: ".md5($imgData));

//make sure caching is turned on
header('Cache-Control: public');

// content type
header('Content-type: ' . $mimetype);

echo $imgData;


// Functions
function cacheTile($tileUrl, $cacheTileFile) {
  global $cacheFileTime;
  logger("$ cacheTileFile 	".$cacheTileFile);
  if(file_exists($cacheTileFile)) {
    logger("Tile exists 		".$tileUrl);
    $fileAge = time()-filemtime($cacheTileFile);
    if($fileAge > $cacheFileTime) {
      logger("Cache old 		".$tileUrl);
      if($data = downloadTile($tileUrl)) {
        saveTile($cacheTileFile, $data);
		logger("Cache renewed 		".$tileUrl);
        return $data;
      }else{
        logger("!! Cache renew error 	".$tileUrl);
        return false;
      }
    }
    logger("Using cache 		".$tileUrl);
    return file_get_contents($cacheTileFile);
  }else{
    logger("Tile not in caches  ".$tileUrl);
    if($data = downloadTile($tileUrl)) {
      logger("Cache created 		".$tileUrl);
      saveTile($cacheTileFile, $data);
      return $data;
    }else{
      logger("!! Cache create error 	".$tileUrl);
      return false;
    }
  }
}

function saveTile($cacheTileFile, $data) {
  if(!file_exists(dirname($cacheTileFile))) {
    mkdir(dirname($cacheTileFile), 0777, true);
  }
  return file_put_contents($cacheTileFile, $data);
}

function downloadTile($tileUrl) {
  $ch = curl_init($tileUrl);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

  $data = curl_exec($ch);
  $header = curl_getinfo($ch);

  if( $header['http_code'] == "200"){
    curl_close($ch);
    return $data;
  }else{
    curl_close($ch);
    return false;
  }
}

function logger($line) {
global $logging;
  if($logging) {
    file_put_contents('log.txt', $line."\n", FILE_APPEND);
  }
}
