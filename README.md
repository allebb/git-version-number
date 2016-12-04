Git Version Number
==================

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/allebb/git-version-number/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/allebb/git-version-number/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/ballen/git-version-number/v/stable)](https://packagist.org/packages/ballen/git-version-number)
[![Latest Unstable Version](https://poser.pugx.org/ballen/git-version-number/v/unstable)](https://packagist.org/packages/ballen/git-version-number)
[![License](https://poser.pugx.org/ballen/git-version-number/license)](https://packagist.org/packages/ballen/git-version-number)

A simple library for utilising your project's Git version information as your application version.

Requirements
------------

* PHP >= 5.4.0

License
-------

This library is released under the [MIT license](LICENSE).

Installation
------------

The recommended way of installing this library is via. [Composer](http://getcomposer.org); To install using Composer type the following command at the console:

```shell
composer require ballen/git-version-number
```

Alternately you can add it to your ``composer.json`` file manually in the `require` section like so:

```php
"ballen/git-version-number": "^1.0"
```
Then install the package by running the ``composer update git-version-number`` command.

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

Code coverage can also be ran but requires XDebug installed...

```shell
./vendor/bin/phpunit --coverage-html ./report
```

Support
-------

I am happy to provide support via. my personal email address, so if you need a hand drop me an email at: [ballen@bobbyallen.me]().
