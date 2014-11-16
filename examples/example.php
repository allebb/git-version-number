<?php

require_once '../src/Version.php';

use Ballen\GitVersionNumber\Version;

// Return the standard version number string.
echo (new Version('/home/vagrant/Code/bindhub'))->getVersionString();

// Return the Git Hash (will display if it has not been tagged OR if has been changes since the last tag.)
echo (new Version('/home/vagrant/Code/bindhub'))->getVersionHash();

// Return the Git version number (as an integer)
echo (new Version('/home/vagrant/Code/bindhub'))->getVersionNumber();