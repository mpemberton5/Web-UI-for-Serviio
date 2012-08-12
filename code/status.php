<?php
$startDisabled = "";
$stopDisabled = "disabled";
$statusText = "<font color='red'>".tr('tab_status_status_stopped', 'Stopped')."</font>";
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $errorCode = 0;
    if (getPostVar("save", "")!="") {
        $profiles = array();
        foreach ($_POST as $key=>$val) {
            if (substr($key, 0, 5)=="name_") {
                $uuid = substr($key, 55);
                if ($uuid!="") {
                    $ipAddress = getPostVar("ipAddress_${uuid}", "");
                    $name = $val;
                    $profile = getPostVar("profile_${uuid}", "1"); // Generic DLNA profile
                    $enabled = getPostVar("enabled_${uuid}", "");
                    $access = getPostVar("access_${uuid}", "");
                    $profiles[] = array($uuid, $ipAddress, $name, $profile, $enabled, $access);
                }
            }
        }
        $ip = getPostVar("ip", "");
        $errorCode = $serviio->putStatus($profiles, $ip);
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
$profiles = $serviio->getProfiles();
$serviio->getApplication();

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
