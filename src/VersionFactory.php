<?php

namespace Ballen\GitVersionNumber;

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
