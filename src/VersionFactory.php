<?php

namespace Ballen\GitVersionNumber;

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
class VersionFactory
{

    /**
     * Factory object creation
     * @param string $path Optional custom path to the .git root directory.
     * @return \Ballen\GitVersionNumber\Version
     */
    public static function create($path)
    {
        return new Version($path);
    }
}
