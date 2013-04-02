<?php
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    if (getPostVar("save","")!="") {
        $transcoding = getPostVar("transcoding","0")==1?"true":"false";
        $location = getPostVar("location","");
        $cores = getPostVar("cores","1");
        $audio = getPostVar("audio","")=="downmix"?"true":"false";
        $quality = getPostVar("quality","0")==1?"true":"false";
    	
		$subtitles = getPostVar("subtitles","0")==1?"true":"false";
        $subtitlesextraction = getPostVar("subtitlesextraction","0")==1?"true":"false";
		$hardsubsenabled = getPostVar("hardsubsenabled","0")==1&&(getPostVar("hardsubs","")=="enabled"||getPostVar("hardsubs","")=="")?"true":"false";
		$hardsubsforced = getPostVar("hardsubsenabled","0")==1&&getPostVar("hardsubs","0")=="forced"?"true":"false";
		$language = getPostVar("language","");
		
        $errorCode = $serviio->putDelivery($transcoding,$location,$cores,$audio,$quality,$subtitles,$subtitlesextraction,$hardsubsenabled,$hardsubsforced,$language);
        if ($errorCode===false || $errorCode!=0) {
            $message = $serviio->warning;
        }
    }
}
$serviio->getDelivery();
$numberOfCPUCores = $serviio->getReferenceData('cpu-cores');
?>
