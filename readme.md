# SugaredRim\PHPMD [![Build Status](https://travis-ci.org/sugared-rim/phpmd.svg?branch=master)](https://travis-ci.org/sugared-rim/phpmd) [![Coverage Status](https://coveralls.io/repos/sugared-rim/phpmd/badge.svg?branch=master&service=github)](https://coveralls.io/github/sugared-rim/phpmd?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sugared-rim/phpmd/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sugared-rim/phpmd/?branch=master) [![Code Climate](https://codeclimate.com/github/sugared-rim/phpmd/badges/gpa.svg)](https://codeclimate.com/github/sugared-rim/phpmd)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/cc04033c-35c0-4152-908a-4304c019c708/big.png)](https://insight.sensiolabs.com/projects/cc04033c-35c0-4152-908a-4304c019c708)

> PHPMD sweetened with ease :cherries:

SugaredRim\PHPMD takes an opinionated view of code style checking with [PHPMD](https://github.com/phpmd/phpmd), it is preconfigured to get you up and running as quickly as possible.

## Install

```
$ composer require --dev sugared-rim/phpmd
```

## Usage

Instead of running `phpmd` with all its options, just run `sugared-rim-phpmd` - that's it:

```json
{
    ...
    "require-dev": {
        "sugared-rim/phpmd": ...
    },
    "scripts": {
        "lint": "sugared-rim/phpmd"
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
        "lint": "sugared-rim/phpmd"
    },
    "extra": {
        "sugared-rim/phpmd": {
            "inputPath": "src,tests",
            "reportFormat": "text",
            "ruleSets": "cleancode,codesize,controversial,design,naming,unusedcode"
        }
    }
}
```

## License

MIT © [Michael Mayer](http://schnittstabil.de)
