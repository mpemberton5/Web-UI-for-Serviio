<?php
$language = "en";
$webUIver = "1.1";
$debugLevel = "none"; // none, debug
$debugLoc = "none"; // none, screen
$serviio_host = "127.0.0.1";
$serviio_port = "23423";
$version_req = "1.0.1";

if ($debugLevel == "debug") {
    ini_set('display_errors', 1);
    ini_set('error_reporting', E_ALL);
}

# Available console languages (bundled)
$languages = array(
'bg' => 'Български',
'ca' => 'Català',
'cs' => 'Čeština',
'da' => 'Dansk',
'de' => 'Deutsch',
'en' => 'English',
'es' => 'Español',
'fr' => 'Français',
'hu' => 'Magyar',
'it' => 'Italiano',
'nl' => 'Nederlands',
'no' => 'Norsk',
'pl' => 'Polski',
'pt_BR' => 'Português (Brasil)',
'ro' => 'Română',
'ru' => 'Русский',
'sk' => 'Slovenščina',
'sv' => 'Svenska',
'zh_CN' => '中文 (Simplified)',
'zh_HK' => '中文 (Traditional)'
);

?>
