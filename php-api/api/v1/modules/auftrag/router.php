<?php
function subrouter($var1) {
    if (intval(explode('/', $var1)[0])) {
        $help=explode('/', $var1);
        $_GET['id']=$help[0];
        unset($help[0]);
        $var1=implode("/", $help);
    }
    if (substr($var1,-1,1)=="/") { 
        $var1=substr($var1, 0, -1);
    }
    if ($var1=="") {
        include_once __DIR__."/index.php";
    } elseif (isset(explode("/",$var1)[0]) && file_exists(__DIR__."/".explode("/",$var1)[0]."/router.php")) {
        include_once __DIR__."/".explode("/",$var1)[0]."/router.php";
    } elseif (file_exists(__DIR__."/".$var1."/index.php")) {
        include_once __DIR__."/".$var1."/index.php";
    } else {
        error404();
        exit;
    }
}
Router::subrouter();  //Reset all Paths for the router
Router::add('',function(){
    if (file_exists(__DIR__."/index.php")) {
        include_once __DIR__."/index.php";
    } else {
        error404();
    }
});
Router::add('/([[:ascii:]]*)',function($var1){
    subrouter($var1);
});
Router::run(HOME_DIR."/user");