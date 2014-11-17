<?php

require_once '../src/Version.php';
require_once '../src/VersionFactory.php';

use Ballen\GitVersionNumber\Version;
use Ballen\GitVersionNumber\VersionFactory;

// Using the factory class you can easily return the standard version number string.
echo VersionFactory::create('/home/vagrant/Code/bindhub')->getVersionString() . PHP_EOL;

// Only return the first and second verion number bits (eg. Major and minor)
echo VersionFactory::create('/home/vagrant/Code/bindhub')->getVersionString(2) . PHP_EOL;

// Return the Git Hash (will display if it has not been tagged OR if has been changes since the last tag.)
echo (new Version('/home/vagrant/Code/bindhub'))->getVersionHash() . PHP_EOL;

// Return the Git version number (as an integer)
echo (new Version('/home/vagrant/Code/bindhub'))->getVersionNumber() . PHP_EOL;

// Only return the first version bit (the MAJOR version as a integer)
echo (new Version('/home/vagrant/Code/bindhub'))->getVersionNumber(1) . PHP_EOL;

// Var dump out the version parts.
echo var_dump(VersionFactory::create('/home/vagrant/Code/bindhub')->getVersionBits()) . PHP_EOL;

// Alternatively just use the __toString() method to output the standard version infomation as a string:
echo (VersionFactory::create('/home/vagrant/Code/bindhub')). PHP_EOL;