<?php
if (isset($_POST["language"]) && array_key_exists($_POST["language"],$languages)) {
    $language = $_POST["language"];
    $_COOKIE["language"] = $language;
    setcookie("language",$language,mktime(9,9,9,9,9,9999));
}
$settings = $serviio->getConsoleSettings();
?>
