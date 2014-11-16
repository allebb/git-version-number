<?php

namespace Ballen\GitVersionNumber;

class Version
{

    /**
     * The Git Tag version number.
     * @var string
     */
    private $version = null;

    /**
     * The Git commit hash.
     * @var string
     */
    private $hash = null;

    /**
     * Optional path to the .git directory (root of the project if it is not the same as the PHP script)
     * @var string
     */
    private $git_path;

    /**
     * Class constructor
     * @param string $git_path Optional Git Path to be set when the .git directory is not in the same directory as the PHP script.
     */
    public function __construct($git_path = null)
    {
        if (!is_null($git_path)) {
            $this->git_path = $git_path;
        }
        $this->extractVersion();
    }

    /**
     * Returns the full version number as a string (eg. 1.3.7)
     * @return string
     */
    public function getVersionString()
    {
        return $this->version;
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
     * Returns the version number as a full number (integer) this is the same as the version string but without dots and will drop leading zeros!
     * @return int
     */
    public function getVersionNumber()
    {
        return (int) str_replace('.', '', $this->version);
    }

    /**
     * Extracts the version from the Git repository.
     * @return void
     */
    private function extractVersion()
    {
        $this->version = str_replace('v', '', exec($this->executionPath()));
        $this->versionBits();
    }

    /**
     * Builds the Git execution path.
     * @return string
     */
    private function executionPath()
    {
        if (is_null($this->git_path)) {
            return 'git describe --tags';
        }
        return 'git -C ' . $this->git_path . ' describe --tags';
    }

    /**
     * Computes and sets the version number and hash properties.
     * @return voids
     */
    private function versionBits()
    {
        $version_bits = explode('-', $this->version);
        if (strlen($version_bits[0])) {
            if (isset($version_bits[1])) {
                $version_bits[0] . '.' . $version_bits[1];
            } else {
                $this->version = $version_bits[0] . '.0';
            }
            if (isset($version_bits[2])) {
                $this->hash = $version_bits[2];
            }
        }
    }

}
