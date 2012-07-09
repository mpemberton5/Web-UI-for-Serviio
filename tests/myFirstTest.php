<?php
include("../config.php");
require_once "../lib/RestRequest.inc.php";
require_once "../lib/serviio.php";

class MyFirstTest extends PHPUnit_Framework_TestCase
{
    protected $_serviio = null;

    public function setUp()
    {
        global $serviio_host;
        global $serviio_port;

        // initiate call to service
        $this->_serviio = new ServiioService($serviio_host,$serviio_port);
    }

    public function tearDown()
    {
        unset($this->_serviio);
    }

    public function testGetApplication()
    {
        $appInfo = $this->_serviio->getApplication();
        $this->assertTrue(array_key_exists("version", $appInfo));
        $this->assertTrue(array_key_exists("updateVersionAvailable", $appInfo));
        $this->assertTrue(array_key_exists("edition", $appInfo));
        $this->assertTrue(array_key_exists("licenseID", $appInfo));
        $this->assertTrue(array_key_exists("licenseType", $appInfo));
        $this->assertTrue(array_key_exists("licenseName", $appInfo));
        $this->assertTrue(array_key_exists("licenseEmail", $appInfo));
        $this->assertTrue(array_key_exists("licenseExpiresInMinutes", $appInfo));
    }

    public function testGetConsoleSettings()
    {
        $appInfo = $this->_serviio->getConsoleSettings();
        $this->assertTrue(array_key_exists("language", $appInfo));
        $this->assertTrue(array_key_exists("securityPin", $appInfo));
        $this->assertTrue(array_key_exists("checkForUpdates", $appInfo));
    }
    public function testGetReferenceData()
    {
        $appInfo = $this->_serviio->getReferenceData();
        $this->assertTrue(array_key_exists("language", $appInfo));
        $this->assertTrue(array_key_exists("securityPin", $appInfo));
        $this->assertTrue(array_key_exists("checkForUpdates", $appInfo));
    }
}
