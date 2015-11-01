[![Build Status](https://travis-ci.org/nilportugues/php_backslasher.svg)](https://travis-ci.org/nilportugues/php_backslasher)
[![Coverage Status](https://coveralls.io/repos/nilportugues/php_backslasher/badge.svg?branch=master&service=github?)](https://coveralls.io/github/nilportugues/php_backslasher?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nilportugues/php_backslasher/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nilportugues/php_backslasher/?branch=master) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/e39e4c0e-a402-495b-a763-6e0482e2083d/mini.png)](https://insight.sensiolabs.com/projects/e39e4c0e-a402-495b-a763-6e0482e2083d) [![Latest Stable Version](https://poser.pugx.org/nilportugues/php_backslasher/v/stable)](https://packagist.org/packages/nilportugues/php_backslasher) [![Total Downloads](https://poser.pugx.org/nilportugues/php_backslasher/downloads)](https://packagist.org/packages/nilportugues/php_backslasher) [![License](https://poser.pugx.org/nilportugues/php_backslasher/license)](https://packagist.org/packages/nilportugues/php_backslasher)

# PHP Function BackSlasher

PHAR tool to add all PHP internal functions to its namespace by adding backslash to them.

## Installation

Use [Composer](https://getcomposer.org) to install the package:

```json
$ composer require nilportugues/php_backslasher
```


### Build PHAR:

While the PHAR file is included under `bin/php_backslasher`, but can be built using the following command:

```
$ php -d phar.readonly=false box.phar build
```

You may also like to make it runnable by just giving it permissions to be used as an executable file and hide its extension.

```
$ chmod 755 bin/php_backslasher.phar

$ mv bin/php_backslasher.phar bin/php_backslasher
```
