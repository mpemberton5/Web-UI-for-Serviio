<?php
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    include("../config.php");
    include("../lib/RestRequest.inc.php");
    include("../lib/serviio.php");

    // initiate call to service
    $serviio = new ServiioService($serviio_host,$serviio_port);

    $errorCode = 0;
    $userPasswd = getPostVar("userPasswd","");
    $deliveryQuality = getPostVar("deliveryQuality","");
    $errorCode = $serviio->putRemoteAccess($userPasswd,$deliveryQuality);
    if ($errorCode===false || $errorCode!=0) {
        $message = $serviio->warning;
    }
    return $errorCode;
}

$rmtAccess = $serviio->getRemoteAccess();

?>
