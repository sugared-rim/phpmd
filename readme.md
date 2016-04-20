# Sugared\PHPMD [![Build Status](https://travis-ci.org/schnittstabil/sugared-phpmd.svg?branch=master)](https://travis-ci.org/schnittstabil/sugared-phpmd) [![Coverage Status](https://coveralls.io/repos/schnittstabil/sugared-phpmd/badge.svg?branch=master&service=github)](https://coveralls.io/github/schnittstabil/sugared-phpmd?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/schnittstabil/sugared-phpmd/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/schnittstabil/sugared-phpmd/?branch=master) [![Code Climate](https://codeclimate.com/github/schnittstabil/sugared-phpmd/badges/gpa.svg)](https://codeclimate.com/github/schnittstabil/sugared-phpmd)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/324cd69d-6042-451c-ad74-70769cccfd06/big.png)](https://insight.sensiolabs.com/projects/324cd69d-6042-451c-ad74-70769cccfd06)

> PHPMD sweetened with ease :cherries:

Sugared\PHPMD takes an opinionated view of code style checking with [PHPMD](https://github.com/phpmd/phpmd), it is preconfigured to get you up and running as quickly as possible.

## Install

```
$ composer require --dev schnittstabil/sugared-phpmd
```

## Usage

Instead of running `phpmd` with all its options, just run `sugared-phpmd` - that's it:

```json
{
    ...
    "require-dev": {
        "schnittstabil/sugared-phpmd": ...
    },
    "scripts": {
        "lint": "sugared-phpmd"
    }
}
```

## Configuration

You may overwrite some options by putting it in your `composer.json`.

Some of the default settings:
```json
{
    ...
    "scripts": {
        "lint": "sugared-phpmd"
    },
    "extra": {
        "schnittstabil\/sugared-phpmd": {
            "inputPath": "src,tests",
            "reportFormat": "text",
            "ruleSets": "cleancode,codesize,controversial,design,naming,unusedcode"
        }
    }
}
```

## License

MIT © [Michael Mayer](http://schnittstabil.de)
