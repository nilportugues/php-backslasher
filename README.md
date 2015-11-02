[![Build Status](https://travis-ci.org/nilportugues/php_backslasher.svg)](https://travis-ci.org/nilportugues/php_backslasher)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nilportugues/php_backslasher/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nilportugues/php_backslasher/?branch=master) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/809a5ba0-e7a0-4d05-8533-e94fa0bd8b9a/mini.png)](https://insight.sensiolabs.com/projects/809a5ba0-e7a0-4d05-8533-e94fa0bd8b9a) [![Latest Stable Version](https://poser.pugx.org/nilportugues/php_backslasher/v/stable)](https://packagist.org/packages/nilportugues/php_backslasher) [![Total Downloads](https://poser.pugx.org/nilportugues/php_backslasher/downloads)](https://packagist.org/packages/nilportugues/php_backslasher) [![License](https://poser.pugx.org/nilportugues/php_backslasher/license)](https://packagist.org/packages/nilportugues/php_backslasher)

# PHP Function BackSlasher

Tool to add all PHP internal functions to its namespace by adding backslash to them.

Function resolution without the backslash forces the PHP internals to verify for each function call if function belongs to current namespace or the global namespace. With the backslashed functions PHP does not check the current namespace and therefore execution is faster.

## Usage

```
$ php bin/php_backslasher fix <path/to/directory>
```


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


## Building the PHAR:

While the PHAR file is included under `bin/php_backslasher`, but can be built using the following command:

```
$ php -d phar.readonly=false box.phar build
```

You may also like to make it runnable by just giving it permissions to be used as an executable file and hide its extension.

```
$ chmod 755 bin/php_backslasher.phar 
$ mv bin/php_backslasher.phar bin/php_backslasher
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
