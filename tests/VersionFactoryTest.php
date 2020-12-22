<?php
use Ballen\GitVersionNumber\Version;
use Ballen\GitVersionNumber\VersionFactory;

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
class VersionFactoryTest extends GitVersionTestSuite
{

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        parent::setUp();
    }

    /**
     * Tests the factory instance creation.
     * @return void
     */
    public function testFactoryReturnsVersionInstance()
    {
        echo $this->assertInstanceOf(Version::class, VersionFactory::create(__DIR__ . DIRECTORY_SEPARATOR . 'Stub/collection'));
    }
}
