<?php
use PHPUnit_Framework_TestCase;
use Ballen\GitVersionNumber\Version;
use Ballen\GitVersionNumber\VersionFactory;

class CollectionModelTest extends PHPUnit_Framework_TestCase
{

    public function testFactoryReturnsVersionInstance()
    {
        $this->assertInstanceOf(Version::class, VersionFactory::create(__DIR__ . DIRECTORY_SEPARATOR . 'ProjectStub'));
    }
}
