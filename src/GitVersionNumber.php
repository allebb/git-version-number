<?php

namespace Ballen\GitVersionNumber;

class Version
{

    private $git_path;
    private $version;

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
    public function getFullVersion()
    {
        return $this->version;
    }

    /**
     * Extracts the version from the Git repository.
     * @return void
     */
    private function extractVersion()
    {
        $parts = explode('-', $this->executionPath());
        $structured = 'N/A';
        if (strlen($parts[0])) {
            $structured = str_replace('v', '', $parts[0]);
            if (isset($parts[1])) {
                $this->version .= '.' . $parts[1];
            } else {
                $this->version .= '.0';
            }
        }
    }

    /**
     * Builds the Git Describe path.
     * @return string
     */
    private function executionPath()
    {
        if (is_null($this->git_path)) {
            return 'git describe --tags';
        }
        return 'git -C ' . $this->git_path . ' describe --tags';
    }

}
