<?php
include_once  __DIR__.'/includes/functions.php';
include_once __DIR__.'/includes/Router.php';
parse_str(file_get_contents("php://input"),$_POST);
// Add base route (startpage)
function setheaders() {
    // ini_set("display_errors", false);
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Accept: application/json");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
}
function error404() {
    placeresult(404, "404 - Not found.");
}
function methodnotallowed() {
    placeresult(405, "405 - Method not Allowed.(".$_SERVER['REQUEST_METHOD'].")");
}
function methodnotexist() {
    placeresult(406, "405 - Method not exists.(".$_SERVER['REQUEST_METHOD'].")");
}
function noresult() {
    placeresult(500, "500 - Serverside Error - No Result set!");
}
function available() {
    placeresult(200, "Service available.");
}
function unavailable() {
    placeresult(503, "Service unavailable.");
}

function placeresult($status, $message, $result = null) {
    setheaders();
    http_response_code($status);
    $array=array("message" => $message);
    if ($result!==null) {
        $array["result"]=$result;
    }
    echo json_encode($array);
    exit;
}

function handlerequest($var1) {
    if (substr($var1,-1,1)=="/") { 
        $var1=substr($var1, 0, -1);
    }
    if (file_exists(__DIR__."/modules/".explode('/', $var1)[0]."/router.php")) {
        include_once __DIR__."/modules/".explode('/', $var1)[0]."/router.php";
    } else {
        if ($id=intval(substr( strrchr($var1, '/'), 1))) {
            $_GET['id']=$id;
            $var1=substr($var1, 0, -1*(strlen($id)+1));
        }
        if (file_exists(__DIR__."/modules/".$var1."/index.php")) {
            include_once __DIR__."/modules/".$var1."/index.php"; 
        } else {
            error404();
        }
    }
}
Router::add('/',function(){
    available();
}, array("get", "post", "put", "delete"));
Router::add('/connection.js',function(){
    include __DIR__."/connection.php";
});

Router::add('/([[:ascii:]]*)',function($var1){
    handlerequest($var1);
}, array("get", "post", "put", "delete"));

Router::pathNotFound(function($route) {error404();});
Router::methodNotAllowed(function() {methodnotallowed();});

Router::run(HOME_DIR);