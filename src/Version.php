<?php

namespace Ballen\GitVersionNumber;

use Ballen\Executioner\Executioner as Executable;

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
class Version
{

    /**
     * The git binary path.
     * @var string
     */
    private $gitBin;

    /**
     * Optional path to the .git directory (root of the project if it is not the same as the PHP script)
     * @var string
     */
    private $gitPath;

    /**
     * The Git Tag version number.
     * @var string
     */
    private $version = '0.0.0-0-0000000';

    /**
     * The Git commit hash.
     * @var string
     */
    private $hash = null;

    /**
     * Class constructor
     * @param string $gitPath The root project path (if not the current directory)
     * @param string $gitBin The path to the Git binary (by default will use the system PATH variable.)
     */
    public function __construct($gitPath = '.', $gitBin = 'git')
    {
        $this->gitBin = $gitBin;
        $this->setRepositoryPath($gitPath);
        $this->extractVersion();
    }

    /**
     * Get the version number as a dot seperated string.
     * @param int $bits Optional version number bits to return.
     * @return string
     */
    public function getVersionString($bits = null)
    {
        if (is_null($bits)) {
            return $this->version;
        }
        return implode('.', $this->versionFromBits($bits));
    }

    /**
     * Returns the version number as a full number (integer) this is the same as the version string but without dots and will drop leading zeros!
     * @param int $bits Optional version number bits to return.
     * @return int
     */
    public function getVersionNumber($bits = null)
    {
        if (is_null($bits)) {
            return (int)str_replace('.', '', $this->version);
        }
        return implode('', $this->versionFromBits($bits));
    }

    /**
     * Returns the version hash (if one is present) (eg. g0106dc9)
     * @return string
     */
    public function getVersionHash()
    {
        return $this->hash;
    }

    /**
     * Returns an array containing the version string parts.
     * @return array
     */
    public function getVersionBits()
    {
        return explode('.', $this->getVersionString());
    }

    /**
     * Method overload, outputs the full text version number as outputted by the 'git describe --tags' command.
     * @return string
     */
    public function __toString()
    {
        return $this->version;
    }

    /**
     * Sets the Git repository path ensuring the /.git is appended to the end of the path.
     * @return void
     */
    private function setRepositoryPath($path)
    {
        $this->gitPath = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '.git';
    }

    /**
     * Extracts the version from the Git repository.
     * @return void
     */
    private function extractVersion()
    {
        $git = Executable::make($this->gitBin)
            ->addArgument(sprintf('--git-dir=%s', $this->gitPath))
            ->addArgument('describe')
            ->addArgument('--tags')
            ->addArgument('--always');

        try {
            $git->execute();
        } catch (\Ballen\Executioner\Exceptions\ExecutionException $exception) {
            // We could not obtain/execute the git command.
        }

        $version = trim($git->resultAsText());
        $this->version = '0.0.0-0-' . $version;

        if (strlen($version) > 7) {
            $this->version = str_replace('v', '', $version);
        }
        $this->versionBits();
    }

    /**
     * Computes and sets the version number and object hash properties.
     * @return void
     */
    private function versionBits()
    {
        $versionBits = explode('-', $this->version);
        if (strlen($versionBits[0])) {
            $this->version = $versionBits[0];
            if (isset($versionBits[1])) {
                $this->version = $versionBits[0] . '.' . $versionBits[1];
            }
            if (isset($versionBits[2])) {
                $this->hash = $versionBits[2];
            }
        }
    }

    /**
     * Returns an customised array of the total number of version bits.
     * @param int $bits The total number of bits (segments) to return.
     * @return array
     */
    private function versionFromBits($bits)
    {
        $version = [];
        foreach (range(0, ($bits - 1)) as $bit) {
            $version[$bit] = $this->getVersionBits()[$bit];
        }
        return $version;
    }
}
