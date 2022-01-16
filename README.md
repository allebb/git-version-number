Git Version Number
==================

[![Build](https://github.com/allebb/git-version-number/workflows/build/badge.svg)](https://github.com/allebb/git-version-number/actions)
[![Code Coverage](https://codecov.io/gh/allebb/git-version-number/branch/master/graph/badge.svg)](https://codecov.io/gh/allebb/git-version-number)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/allebb/git-version-number/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/allebb/git-version-number/?branch=master)
[![Code Climate](https://codeclimate.com/github/allebb/git-version-number/badges/gpa.svg)](https://codeclimate.com/github/allebb/git-version-number)
[![Latest Stable Version](https://poser.pugx.org/ballen/git-version-number/v/stable)](https://packagist.org/packages/ballen/git-version-number)
[![Latest Unstable Version](https://poser.pugx.org/ballen/git-version-number/v/unstable)](https://packagist.org/packages/ballen/git-version-number)
[![License](https://poser.pugx.org/ballen/git-version-number/license)](https://packagist.org/packages/ballen/git-version-number)

A simple library for utilising your project's Git version information as your application version.

Requirements
------------

This library is unit tested against PHP 7.3, 7.4, 8.0 and 8.1!

If you need to use an older version of PHP, you should instead install the 2.x version of this library (see below for details).

License
-------

This library is released under the [MIT license](LICENSE).

Installation
------------

The recommended way of installing this library is via. [Composer](http://getcomposer.org); To install using Composer type the following command at the console:

```shell
composer require ballen/git-version-number
```

**If you need to use an older version of PHP, version 1.x.x supports PHP 5.6, 7.0, 7.1 and 7.2, you can install this version using Composer with this command instead:**

```shell
composer require ballen/git-version-number ^1.0
```


Examples
--------

A set of working examples can be found in the ``/examples`` directory.

Tests and coverage
------------------

This library is fully unit tested using [PHPUnit](https://phpunit.de/).

If you wish to run the tests yourself you should run the following:

```shell
# Install the Library with the 'development' packages this then includes PHPUnit!
composer install


# Now we run the unit tests (from the root of the project) like so:
./vendor/bin/phpunit
```

Code coverage can also be run but requires XDebug installed...

```shell
./vendor/bin/phpunit --coverage-html ./report
```

Support
-------

I am happy to provide support via. my personal email address, so if you need a hand drop me an email at: [ballen@bobbyallen.me]().
