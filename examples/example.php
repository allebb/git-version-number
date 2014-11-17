<?php

require_once '../src/Version.php';
require_once '../src/VersionFactory.php';

use Ballen\GitVersionNumber\Version;
use Ballen\GitVersionNumber\VersionFactory;

// Using the factory class you can easily return the standard version number string.
echo VersionFactory::create('/home/vagrant/Code/bindhub')->getVersionString() . PHP_EOL;

// Return the Git Hash (will display if it has not been tagged OR if has been changes since the last tag.)
echo (new Version('/home/vagrant/Code/bindhub'))->getVersionHash() . PHP_EOL;

// Return the Git version number (as an integer)
echo (new Version('/home/vagrant/Code/bindhub'))->getVersionNumber() . PHP_EOL;

// Var dump out the version parts.
echo var_dump(VersionFactory::create('/home/vagrant/Code/bindhub')->getVersionBits());