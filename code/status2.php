<?php
include("../config.php");
include("../lib/RestRequest.inc.php");
include("../lib/serviio.php");

// initiate call to service
$serviio = new ServiioService($serviio_host,$serviio_port);

$errorCode = 0;
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    if (getPostVar("type", "")=="start") {
        $errorCode = $serviio->postAction("startServer");
        //echo "<xml><type>started</type></xml>";
    } else if (getPostVar("type", "")=="stop") {
        $errorCode = $serviio->postAction("stopServer");
        //echo "<xml><type>stopped</type></xml>";
    } else {
        //echo "<xml><type>bad</type></xml>";
    }
    return $errorCode;
}
die();
$startDisabled = "";
$stopDisabled = "disabled";
$statusText = "<font color='red'>".tr('tab_status_status_stopped', 'Stopped')."</font>";
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $errorCode = 0;
    if (getPostVar("save", "")!="") {
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
        $bound_nic = getPostVar("bound_nic", "");
        $errorCode = $serviio->putStatus($profiles, $bound_nic);
    } else if (getPostVar("start", "")!="") {
        $errorCode = $serviio->postAction("startServer");
    } else if (getPostVar("stop", "")!="") {
        $errorCode = $serviio->postAction("stopServer");
    }
    if ($errorCode===false || $errorCode!=0) {
        $message = $serviio->warning;
    }
}
$statusResponse = $serviio->getStatus();
if ($statusResponse["serverStatus"] == "STARTED") {
    $statusText = "<font color='green'>".tr('tab_status_status_running', 'Running')."</font>";
    $startDisabled = "disabled";
    $stopDisabled = "";
}
$profiles = $serviio->getReferenceData('profiles');
$interfaces = $serviio->getReferenceData('networkInterfaces');
$accesses = $serviio->getReferenceData('accessGroups');

function status_icon($status)
{
    $icon = 'orange';
    if ($status=='INACTIVE') {
        $icon = 'red';
    } else if ($status=='ACTIVE') {
        $icon = 'green';
    }
    return "<img src='images/bullet_${icon}.png' alt='${status}'>";
}
?>
