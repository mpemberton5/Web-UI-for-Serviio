<?php
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    if (getPostVar("save","")!="") {
        $transcoding = getPostVar("transcoding","0")==1?"true":"false";
        $location = getPostVar("location","");
        $cores = getPostVar("cores","1");
        $audio = getPostVar("audio","")=="downmix"?"true":"false";
        $quality = getPostVar("quality","0")==1?"true":"false";
        $errorCode = $serviio->putTranscoding($transcoding,$location,$cores,$audio,$quality);
        if ($errorCode===false || $errorCode!=0) {
            $message = $serviio->warning;
        }
    }
}
$serviio->getTranscoding();
$serviio->getCpuCores();
?>
