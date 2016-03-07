<?php
use PHPUnit_Framework_TestCase;
use Ballen\GitVersionNumber\Version;
use Ballen\GitVersionNumber\VersionFactory;

class VersionTest extends PHPUnit_Framework_TestCase
{

    const STUB_DIR = __DIR__ . DIRECTORY_SEPARATOR . 'Stub';
    const STUB_ARCHIVE = 'example_project.zip';

    /**
     * Sets' up the test, we'll extract our stub Git project given that GitSCM is not capable of versioning a .git directory.
     * @return void
     */
    public function setUp()
    {
        $stub_archive = new ZipArchive();
        if ($stub_archive->open(self::STUB_DIR . DIRECTORY_SEPARATOR . self::STUB_ARCHIVE)) {
            $stub_archive->extractTo(self::STUB_DIR);
            $stub_archive->close();
        } else {
            die('Unable to extract stub project.');
        }
        parent::setUp();
    }

    public function testInstantiation()
    {
        return true;
    }
}
