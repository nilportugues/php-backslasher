[![Build Status](https://travis-ci.org/nilportugues/php_backslasher.svg)](https://travis-ci.org/nilportugues/php_backslasher)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nilportugues/php_backslasher/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nilportugues/php_backslasher/?branch=master) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/809a5ba0-e7a0-4d05-8533-e94fa0bd8b9a/mini.png)](https://insight.sensiolabs.com/projects/809a5ba0-e7a0-4d05-8533-e94fa0bd8b9a) [![Latest Stable Version](https://poser.pugx.org/nilportugues/php_backslasher/v/stable)](https://packagist.org/packages/nilportugues/php_backslasher) [![Total Downloads](https://poser.pugx.org/nilportugues/php_backslasher/downloads)](https://packagist.org/packages/nilportugues/php_backslasher) [![License](https://poser.pugx.org/nilportugues/php_backslasher/license)](https://packagist.org/packages/nilportugues/php_backslasher)

# PHP BackSlasher

Tool to add all PHP **internal functions and constants** to its namespace by adding backslash to them.

Function resolution without the backslash forces the PHP internals to verify for each function call if function or constant belongs to current namespace or the global namespace. With the backslash  PHP does not check the current namespace and therefore execution is faster when using OP Cache.

**Idea from Nikita Popov talk**: 
- [PHP 7 – What changed internally? (PHP Barcelona 2015)](http://www.slideshare.net/nikita_ppv/php-7-what-changed-internally-php-barcelona-2015) (slide [72](http://image.slidesharecdn.com/php7internals-151101105627-lva1-app6891/95/php-7-what-changed-internally-php-barcelona-2015-72-638.jpg?cb=1446375542))

## Installation

Use [Composer](https://getcomposer.org) to install the package:

```
$ composer require nilportugues/php_backslasher
```

## Usage

```
$ php bin/php_backslasher fix <path/to/directory>
```

###Output

Works for functions in conditional statements, negative conditionals, placed in an array as key or value and any other normal use.

Also adds a backslash to defined constants and true, false and null values.

```php
echo strlen('Hello World');

return true;

// becomes:
echo \strlen('Hello World');

return \true;
```


## Contribute

Contributions to the package are always welcome!

* Report any bugs or issues you find on the [issue tracker](https://github.com/nilportugues/php_backslasher/issues/new).
* You can grab the source code at the package's [Git repository](https://github.com/nilportugues/php_backslasher).



## Support

Get in touch with me using one of the following means:

 - Emailing me at <contact@nilportugues.com>
 - Opening an [Issue](https://github.com/nilportugues/php_backslasher/issues/new)



## Authors

* [Nil Portugués Calderó](http://nilportugues.com)
* [The Community Contributors](https://github.com/nilportugues/php_backslasher/graphs/contributors)


## License
The code base is licensed under the [MIT license](LICENSE).
