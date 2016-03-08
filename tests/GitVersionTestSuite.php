<?php

class GitVersionTestSuite extends PHPUnit_Framework_TestCase
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

    /**
     * Test suite teardown - Delete the stub project directory.
     * @return void
     */
    public function tearDown()
    {
        //self::Recursive_Rmdir(self::STUB_DIR . DIRECTORY_SEPARATOR . 'collection');
        parent::tearDown();
    }

    /**
     * Recursively delete a directory.
     * @param string $dir The directory path to delete.
     * @return void
     */
    private static function Recursive_Rmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . "/" . $object)) {
                        self::Recursive_Rmdir($dir . "/" . $object);
                    } else {
                        unlink($dir . "/" . $object);
                    }
                }
            }
            rmdir($dir);
        }
    }
}
