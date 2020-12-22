<?php

/**
 * Git Version Number
 *
 * A library for extracting and utilising your project's Git version information.
 *
 * @author Bobby Allen <ballen@bobbyallen.me>
 * @license https://raw.githubusercontent.com/allebb/git-version-number/master/LICENSE
 * @link https://github.com/allebb/git-version-number
 * @link http://bobbyallen.me
 *
 */
class GitVersionTestSuite extends PHPUnit_Framework_TestCase
{

    /**
     * @var string
     */
    public static $stubDirectory = __DIR__ . DIRECTORY_SEPARATOR . 'Stub';

    /**
     * Sets' up the test, we'll extract our stub Git project given that GitSCM is not capable of versioning a .git directory.
     * @return void
     */
    public function setUp()
    {
        try {
            self::extractStubProject('example_project.zip');
            self::extractStubProject('no_tags_project.zip');
        } catch (\RuntimeException $exception) {
            $this->fail($exception->getMessage());
        }
        parent::setUp();
    }

    /**
     * Extracts the specified stub project.
     * @param string $filename The archive name to extract.
     * @throws \RuntimeException
     */
    private static function extractStubProject($filename)
    {

        //die(self::$stubDirectory . DIRECTORY_SEPARATOR . $filename);
        $stub_archive = new ZipArchive();
        if ($stub_archive->open(self::$stubDirectory . DIRECTORY_SEPARATOR . $filename)) {
            $stub_archive->extractTo(self::$stubDirectory);
            $stub_archive->close();
        } else {
            throw new \RuntimeException("Unable to extract the stub project archive from {$filename}!");
        }
    }
}
