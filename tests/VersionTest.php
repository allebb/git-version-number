<?php
use Ballen\GitVersionNumber\Version;

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
        $this->assertEquals('1.0.3.11', (string) $this->instance);
    }

    public function testVersionBitsArray()
    {
        $version_bits_array = $this->instance->getVersionBits();
        $this->assertEquals(4, count($version_bits_array));
        $this->assertEquals('1', $version_bits_array[0]);
        $this->assertEquals('0', $version_bits_array[1]);
        $this->assertEquals('3', $version_bits_array[2]);
        $this->assertEquals('11', $version_bits_array[3]);
    }

    public function testVersionFromBits()
    {
        $version_bits_array = $this->instance->getVersionFromBits(3);
        $this->assertEquals(1, count($version_bits_array));
        $this->assertEquals('3', $version_bits_array[0]);
    }

    public function testCurrentDirectoryInstantiation()
    {
        $current_dir_instantiation = new Version();
        $this->assertEquals(8, strlen($current_dir_instantiation->getVersionHash()));
    }
}
