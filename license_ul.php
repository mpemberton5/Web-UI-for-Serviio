<?php
include("config.php");
include("lib/RestRequest.inc.php");
include("lib/serviio.php");

if (substr($_FILES['uploadFile']['name'],-4) == ".lic") {
    $serviio = new ServiioService($serviio_host,$serviio_port);
    echo $serviio->PutLicenseUpload(file_get_contents($_FILES['uploadFile']['tmp_name']));
} else {
    echo "<result>\n  <errorCode>99999</errorCode>\n  <Text>Error! File doesn't appear to be license file.</Text>\n</result>";
}
?>
