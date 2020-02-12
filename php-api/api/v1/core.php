<?php
global $development;
$development=true;
global $limit, $page, $offset, $time;
setheaders();
/**
 * Class for Connection to DB
 * implements the offset/Page/limit strategy
 */
class APICONNECT extends DBObject{
    function execute($query, $arrayData = array()) {
        global $limit, $offset;
        if (isset($limit)) {
            $query.=" LIMIT ".$limit;
            if (isset($offset)) {
                $query.=" OFFSET ".$offset;
            }
        }
        return parent::execute($query, $arrayData);
    }
}
class APICURL {
    function __construct($url, $method="post", $direct=false)
    {
        $this->status=0;
        $this->url=SITE_URL."api/v1/".ltrim($url,"/");
        $this->method=strtolower($method);
        if ($direct) {
            if (is_array($direct)) {
                return $this->request($direct); 
            }
            return $this->request();
        }
        return true;
    }
    function request($postdata=array()) {
        //url-ify the data for the POST
        $fields_string=http_build_query($postdata);

        //open connection
        $ch = curl_init($this->url);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        switch ($this->method) {
            default:
            case "get":
                break;
            case "post":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                break;
            case "put":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                break;
            case "delete":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                break;
        }

        //transfer the user_agent
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        //transfer the cookies from the session
        if (isset($_COOKIE[session_name()])) {
            curl_setopt($ch, CURLOPT_COOKIE, "cookieconsent_status=".$_COOKIE["cookieconsent_status"].";".session_name().'='.$_COOKIE[session_name()].";");
        }
        
        session_write_close();

        //execute post
        $json=ltrim(curl_exec($ch) , "﻿");
        $result=new \stdClass();
        if ($json!="") {
            $result=json_decode($json);
        }
        $result->status=curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $result->url=$this->url;
        $result->method=$this->method;

        
        $this->status=$result->status;
        $this->result=$result;
        //close connection
        curl_close($ch);
        session_start();
        return $result;
    }
}


$limit=20;      // Standard für Limit
$page=1;        // Standard für Page    !!HAVE TO BE ZERO/ONE == the same
$offset=0;      // Standard für Offset  !!HAVE TO BE ZERO
$time=date('Y-m-d H:i:s');
if (isset($_GET['limit']) && intval($_GET['limit']) && $_GET['limit']>0) {
    $limit=$_GET['limit'];
} elseif (isset($_GET['limit']) && intval($_GET['limit']) && $_GET['limit']==-1) {
    unset($limit);
}
if (isset($_GET['page']) && intval($_GET['page']) && isset($limit)) {
    $page=$_GET['page'];
    if ($page==0) {$page=1;}
    if ($page>0) {
        $offset=($page-1)*$limit;
    } else {
        $offset=-1*($page+1)*$limit;
    }
}
if (isset($_GET['offset']) && (intval($_GET['offset']) || !$_GET['offset'])) {
    $offset+=$_GET['offset'];
}
if (isset($_GET['time']) && (intval($_GET['time']) || !$_GET['time'])) {
    if (!$_GET['time']) {
        $time=date('Y-m-d H:i:s', 0);
    } else {
        $time=date('Y-m-d H:i:s', $_GET['time']);
    }
    
}


//FUNCTIONS  
if(function_exists(strtolower($_SERVER['REQUEST_METHOD']))) {
    http_response_code(500);
    // execute function
    strtolower($_SERVER['REQUEST_METHOD'])();
} else {
    methodnotexist();
}
noresult();
exit;