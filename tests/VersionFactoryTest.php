<?php
use Ballen\GitVersionNumber\Version;
use Ballen\GitVersionNumber\VersionFactory;

class VersionFactoryTest extends GitVersionTestSuite
{

    /**
     * Tests the factory instance creation.
     * @return void
     */
    public function testFactoryReturnsVersionInstance()
    {
        echo $this->assertInstanceOf(Version::class, VersionFactory::create(__DIR__ . DIRECTORY_SEPARATOR . 'Stub/collection'));
    }
}
