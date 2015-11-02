[![Build Status](https://travis-ci.org/nilportugues/php_backslasher.svg)](https://travis-ci.org/nilportugues/php_backslasher)
[![Coverage Status](https://coveralls.io/repos/nilportugues/php_backslasher/badge.svg?branch=master&service=github?)](https://coveralls.io/github/nilportugues/php_backslasher?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nilportugues/php_backslasher/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nilportugues/php_backslasher/?branch=master) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/809a5ba0-e7a0-4d05-8533-e94fa0bd8b9a/mini.png)](https://insight.sensiolabs.com/projects/809a5ba0-e7a0-4d05-8533-e94fa0bd8b9a) [![Latest Stable Version](https://poser.pugx.org/nilportugues/php_backslasher/v/stable)](https://packagist.org/packages/nilportugues/php_backslasher) [![Total Downloads](https://poser.pugx.org/nilportugues/php_backslasher/downloads)](https://packagist.org/packages/nilportugues/php_backslasher) [![License](https://poser.pugx.org/nilportugues/php_backslasher/license)](https://packagist.org/packages/nilportugues/php_backslasher)

# PHP Function BackSlasher

Tool to add all PHP internal functions to its namespace by adding backslash to them.

Function resolution without the backslash forces the PHP internals to verify for each function call if function belongs to current namespace or the global namespace. With the backslashed functions PHP does not check the current namespace and therefore execution is faster.

## Installation

### As a dependency using Composer
Use [Composer](https://getcomposer.org) to install the package:

```
$ composer require nilportugues/php_backslasher
```

### As a PHAR file

You can also use already last built `.phar`.

``` bash
$ git clone git@github.com:nilportugues/php_backslasher.git
$ cd php_backslasher
$ php build/php_backslasher.phar
```

You can copy the `.phar` file as a global script

``` bash
$ cp build/php_backslasher.phar /usr/local/bin/php_backslasher
```


## Usage

```
$ php bin/php_backslasher fix <path/to/directory>
```


## Custom PHAR:

While the PHAR file is included under `bin/php_backslasher`, but can be built using the following command:

```
$ php -d phar.readonly=false box.phar build
```

You may also like to make it runnable by just giving it permissions to be used as an executable file and hide its extension.

```
$ chmod 755 bin/php_backslasher.phar && mv bin/php_backslasher.phar bin/php_backslasher
```
