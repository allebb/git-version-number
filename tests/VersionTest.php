<?php
use Ballen\GitVersionNumber\Version;
use Ballen\GitVersionNumber\VersionFactory;

class VersionTest extends GitVersionTestSuite
{

    private $instance;

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        $this->instance = new Version(parent::STUB_DIR . DIRECTORY_SEPARATOR . 'collection');
        parent::__construct($name, $data, $dataName);
    }

    public function testVersionAsString()
    {
        $this->assertEquals('1.0.3.11', $this->instance->getVersionString());
    }

    public function testVersionAsStringWithSpecificNumberOfElements()
    {
        $this->assertEquals('1.0.3', $this->instance->getVersionString(3));
    }

    public function testVersionAsStringWithMajorVersionElementOnly()
    {
        $this->assertEquals('1', $this->instance->getVersionString(1));
    }

    public function testVersionNumberAsInteger()
    {
        $this->assertEquals(10311, $this->instance->getVersionNumber());
    }

    public function testVersionNumberAsIntegerWithSpecificNumberOfElements()
    {
        $this->assertEquals(103, $this->instance->getVersionNumber(3));
    }

    public function testVersionAsIntegerWithMajorVersionElementOnly()
    {
        $this->assertEquals(1, $this->instance->getVersionNumber(1));
    }

    public function testVersionHash()
    {
        $this->assertEquals('g1a45f68', $this->instance->getVersionHash());
    }

    public function testToStringMethod()
    {
        $this->assertEquals('1.0.3', (string) $this->instance);
    }
}
