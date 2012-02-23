<?php
/**
 *  *  */
function getPostVar($var, $def="")
{
    return isset($_POST[$var])?$_POST[$var]:$def;
}

include("../config.php");
if ($debugLevel == "debug") {
    ini_set('display_errors', 1);
    ini_set('error_reporting', E_ALL);
}
include("../lib/RestRequest.inc.php");
include("../lib/serviio.php");

// initiate call to service
$serviio = new ServiioService($serviio_host,$serviio_port);

$errorCode = 0;

$zero = $_POST;
$profiles = array();
foreach ($_POST as $key=>$val) {
    if (substr($key, 0, 5)=="name_") {
        $uuid = substr($key, 5);
        if ($uuid!="") {
            $ipAddress = getPostVar("ipAddress_${uuid}", "");
            $name = $val;
            $profile = getPostVar("profile_${uuid}", "1"); // Generic DLNA profile
            $profiles[] = array($uuid, $ipAddress, $name, $profile);
        }
    }
}
$ip = getPostVar("ip", "");
$errorCode = $serviio->putStatus($profiles, $ip);
return $errorCode;
return print_r($zero);
return print_r($zero["tab"]);
?>
