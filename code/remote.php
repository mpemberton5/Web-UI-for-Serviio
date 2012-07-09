<?php
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    if (getPostVar("save","")!="") {
        $userPasswd = getPostVar("userPasswd","");
        $deliveryQuality = getPostVar("deliveryQuality","");
        $errorCode = $serviio->putTranscoding($userPasswd,$deliveryQuality);
        if ($errorCode===false || $errorCode!=0) {
            $message = $serviio->warning;
        }
    }
}
$rmtAccess = $serviio->getRemoteAccess();
?>
