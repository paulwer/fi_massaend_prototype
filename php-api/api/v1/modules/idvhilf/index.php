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
class TEMPLATE {
    public $inr, $auft, $test;
    function __construct() {
        $this->inr=001;
        $this->auft=0051;
        $this->test="Teststring";

    }
}
function get() {

    // hier werden informationen über die IDV_HILF in der Fima zurückgegeben
    // make sure the right data is provided
    if(
        ((!empty($_GET['srplus_ticketnr']) || !empty($_GET['auftragsnummer'])) && !isset($_GET['data']))
    ){
        placeresult(200, array("count" => 2000));
    } elseif (isset($_GET['data'])) {
        if(
            (!empty($_GET['srplus_ticketnr']) || !empty($_GET['auftragsnummer']))
        ){
            placeresult(200, array("count" => 2000, "data" => array("tabledata" => array("inr", "auft", "test"), "row" => array(new TEMPLATE, new TEMPLATE))));
        }        
    }
    // not possible to get all userdata!!!
    placeresult(400, "Unable to get data. Request is incomplete. (missing id)");
    exit;
}
?>