<?php
//return format
/**
 * { "message": <string>
 *   "result":  [
 *      "value": <string|integer...>,
 *      "nextvalue": <string|integer...>...
 *   ]
 * }
 */
// required headers
require_once "core.php";

//----------------------FUNCTIONS---------------------------------------------------------------
function get() {
    
    // make sure the right data is provided
    if(
        (!empty($_GET['id']) || !empty($_GET['username']) || !empty($_GET['email']))
    ){
        // preset values
        if (empty($_GET['id']) && !((isset($_GET['username']) && $_GET['id']=getuserid($_GET['username'])) || (isset($_GET['email']) && $_GET['id']=getuserid($_GET['email'])))) {
            placeresult(404, "No User found.");
            exit;
        } 
    
        // result
        if (isUser($_GET['id'])) {
            $user=new User($_GET['id']);
            if (isset($_GET['employee'])) {$user->employee;}
            if (isset($_GET['data'])) {$user->data;}
            if (isset($_GET['instructor'])) {$user->employee->instructor; unset($user->employee->auth);}
            if (isset($_GET['office_worker'])) {$user->employee->office_worker; unset($user->employee->auth);}

            // preset output
            unset($user->auth);
            placeresult(200, "User ".$_GET['id'], $user);
        } else {
            $user=new User();
            if (isset($_GET['employee'])) {$user->employee;}
            if (isset($_GET['data'])) {$user->data;}
            if (isset($_GET['instructor'])) {$user->employee->instructor; unset($user->employee->auth);}
            if (isset($_GET['office_worker'])) {$user->employee->office_worker; unset($user->employee->auth);}

            // preset output
            unset($user->auth);
            placeresult(404, "User not found!", $user);
        }
    } else {
        // not possible to get all userdata!!!
        placeresult(400, "Unable to get data. Request is incomplete. (missing id)");
        exit;
    }
}
?>