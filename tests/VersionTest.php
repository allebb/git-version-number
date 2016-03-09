<?php
use Ballen\GitVersionNumber\Version;

/**
 * Git Version Number
 * 
 * A library for extracting and utilising your project's Git version information.
 *
 * @author Bobby Allen <ballen@bobbyallen.me>
 * @license https://raw.githubusercontent.com/bobsta63/git-version-number/master/LICENSE
 * @link https://github.com/bobsta63/git-version-number
 * @link http://www.bobbyallen.me
 *
 */
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

    public function testVersionBitsArrayNoTags()
    {
        $no_tags_example = new Version();
        $version_bits_array = $this->instance->getVersionBits();
        $this->assertEquals(4, count($version_bits_array));
        $this->assertEquals('1', $version_bits_array[0]);
        $this->assertEquals('0', $version_bits_array[1]);
        $this->assertEquals('3', $version_bits_array[2]);
        $this->assertEquals('11', $version_bits_array[3]);
    }

    public function testCurrentDirectoryInstantiation()
    {
        $current_dir_instantiation = new Version(parent::STUB_DIR . DIRECTORY_SEPARATOR . 'hooker');
        $this->assertEquals(false, $current_dir_instantiation->getVersionNumber());
    }
}
