<?php
include_once __DIR__.'/../data/config/autoload.php';
include_once __DIR__.'/DBTable.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);
define( 'HOME_DIR', homeDIR() );
define( 'SITE_URL', siteURL() );
define( 'DATE_NOW', date("Y-m-d H:i:s"));
function homeDIR() {
	$homedir=explode("/", str_replace($_SERVER['DOCUMENT_ROOT'],"",str_replace("\\","/",__DIR__)));
	unset($homedir[count($homedir)-1]);
	if (count($homedir)>1) {unset($homedir[0]); $homedir[]="";}
	$homedir=implode("/", $homedir);
	return "/".substr($homedir,0, strlen($homedir)-1);
}
function siteURL() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$domainName = $_SERVER['HTTP_HOST'];
    return $protocol.$domainName.HOME_DIR;
}
