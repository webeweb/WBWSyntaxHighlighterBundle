syntaxhighlighter-bundle
========================

[![Build Status](https://img.shields.io/travis/webeweb/syntaxhighlighter-bundle/master.svg?style=flat-square)](https://travis-ci.com/webeweb/syntaxhighlighter-bundle)
[![Coverage Status](https://img.shields.io/coveralls/webeweb/syntaxhighlighter-bundle/master.svg?style=flat-square)](https://coveralls.io/github/webeweb/syntaxhighlighter-bundle?branch=master)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/quality/g/webeweb/syntaxhighlighter-bundle/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/webeweb/syntaxhighlighter-bundle/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/webeweb/syntaxhighlighter-bundle.svg?style=flat-square)](https://packagist.org/packages/webeweb/syntaxhighlighter-bundle)
[![Latest Unstable Version](https://img.shields.io/packagist/vpre/webeweb/syntaxhighlighter-bundle.svg?style=flat-square)](https://packagist.org/packages/webeweb/syntaxhighlighter-bundle)
[![License](https://img.shields.io/packagist/l/webeweb/syntaxhighlighter-bundle.svg?style=flat-square)](https://packagist.org/packages/webeweb/syntaxhighlighter-bundle)
[![composer.lock](https://img.shields.io/badge/.lock-uncommited-important.svg?style=flat-square)](https://packagist.org/packages/webeweb/syntaxhighlighter-bundle)

Integrate SyntaxHighlighter with Symfony 2 and more.

> IMPORTANT NOTICE: This package is no longer maintained and its classes have
> been migrated into package "core-bundle" (available into version up to 2.15.0
> and more) [Core bundle](https://github.com/webeweb/core-bundle/)

`syntaxhighlighter-bundle` eases the use of SyntaxHighlighter to highlight
syntax in your Symfony application by providing Twig extensions and PHP
objects to do the heavy lifting. The bundle include the excellent JS library
[SyntaxHighlighter](http://alexgorbatchev.com/SyntaxHighlighter/).

Dry out your SyntaxHighlighter code by writing it all in PHP !

Includes:

- [SyntaxHighlighter 3.0.83](http://alexgorbatchev.com/SyntaxHighlighter/)

---

## Compatibility

[![PHP](https://img.shields.io/packagist/php-v/webeweb/syntaxhighlighter-bundle.svg?style=flat-square)](http://php.net)
[![Symfony](https://img.shields.io/badge/symfony-%5E2.7%7C%5E3.0%7C%5E4.0-brightness.svg?style=flat-square)](https://symfony.com)

---

## Installation

Open a command console, enter your project directory and execute the following
command to download the latest stable version of this package:

```bash
$ composer require webeweb/syntaxhighlighter-bundle
```

This command requires you to have Composer installed globally, as explained in
the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the
Composer documentation.

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
    public function registerBundles() {
        $bundles = [
            // ...
            new WBW\Bundle\CoreBundle\WBWCoreBundle(),
            new WBW\Bundle\SyntaxHighlighterBundle\WBWSyntaxHighlighterBundle(),
        ];

        // ...

        return $bundles;
    }
```

Once the bundle is added then do:

```bash
$ php bin/console wbw:core:unzip-assets
$ php bin/console assets:install
```

---

## Usage

Read the [documentation](Resources/doc/index.md).

---

## Testing

To test the package, is better to clone this repository on your computer.
Open a command console and execute the following commands to download the latest
stable version of this package:

```bash
$ git clone https://github.com/webeweb/syntaxhighlighter-bundle.git
$ cd syntaxhighlighter-bundle
$ composer install
```

Once all required libraries are installed then do:

```bash
$ vendor/bin/phpunit
```

---

## License

`syntaxhighlighter-bundle` is released under the MIT License. See the bundled
[LICENSE](LICENSE) file for details.
