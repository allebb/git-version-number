<?php

namespace Ballen\GitVersionNumber;

use Ballen\Executioner\Executioner as Executable;

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
class Version
{

    /**
     * The git binary path.
     * @var string 
     */
    private $git_bin;

    /**
     * Optional path to the .git directory (root of the project if it is not the same as the PHP script)
     * @var string
     */
    private $git_path;

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
     * @param type $git_path The root project path (if not the current directory)
     * @param type $git_bin The path to the Git binary (by default will use the system PATH variable.)
     */
    public function __construct($git_path = '.', $git_bin = 'git')
    {
        $this->git_bin = $git_bin;
        $this->setRepositoryPath($git_path);
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
        } else {
            return implode('.', $this->versionFromBits($bits));
        }
    }

    /**
     * Returns the version number as a full number (integer) this is the same as the version string but without dots and will drop leading zeros!
     * @param int $bits Optional version number bits to return.
     * @return int
     */
    public function getVersionNumber($bits = null)
    {
        if (is_null($bits)) {
            return (int) str_replace('.', '', $this->version);
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
        $this->git_path = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '.git';
    }

    /**
     * Extracts the version from the Git repository.
     * @return void
     */
    private function extractVersion()
    {
        $git = Executable::make($this->git_bin)
            ->addArgument(sprintf('--git-dir=%s', $this->git_path))
            ->addArgument('describe')
            ->addArgument('--tags')
            ->addArgument('--always');
        try {
            $git->execute();
            $version = trim($git->resultAsText());
            if (strlen($version) > 7) {
                $this->version = str_replace('v', '', $version);
            } else {
                $this->version = '0.0.0-0-' . $version;
            }
        } catch (\Ballen\Executioner\Exceptions\ExecutionException $exception) {
            
        }
        $this->versionBits();
    }

    /**
     * Computes and sets the version number and object hash properties.
     * @return void
     */
    private function versionBits()
    {
        $version_bits = explode('-', $this->version);
        if (strlen($version_bits[0])) {
            if (isset($version_bits[1])) {
                $this->version = $version_bits[0] . '.' . $version_bits[1];
            } else {
                $this->version = $version_bits[0];
            }
            if (isset($version_bits[2])) {
                $this->hash = $version_bits[2];
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
