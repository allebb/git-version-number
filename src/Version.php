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
        } else {
            return implode('.', $this->versionFromBits($bits));
        }
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
        return 'git --git-dir=' . $this->git_path . ' describe --tags';
    }

    /**
     * Computes and sets the version number and hash object properties.
     * @return voids
     */
    private function versionBits()
    {
        $version_bits = explode('-', $this->version);
        if (strlen($version_bits[0])) {
            if (isset($version_bits[1])) {
                $this->version = $version_bits[0] . '.' . $version_bits[1];
            } else {
                $this->version = $version_bits[0] . '.0';
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
