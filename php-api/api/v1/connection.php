<?php
include_once __DIR__."/../../includes/functions.php";

//Diese PHP-Datei gibt eine aktualisierte Version der LockScreen.js für den Benutzer aus
header('Content-Type: text/javascript; charset: utf-8');

if (file_exists(__DIR__."/connection.js")){
$output=file_get_contents(__DIR__."/connection.js");
$output=str_replace("{{<url>}}", SITE_URL, $output);
ob_start();
ob_clean();
echo $output;
}
?>