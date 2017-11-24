<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$dir=getcwd()."/cache";
echo $dir."<br>";
function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
        if ('.' === $file || '..' === $file) continue;
        if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
        else unlink("$dir/$file");
    }
    rmdir($dir);
}
rmdir_recursive($dir);
echo "<br>Compeleted";
?>