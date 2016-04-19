<?php

namespace Schnittstabil\Sugared\PHPMD\TextUI;

use Schnittstabil\Sugared\PHPMD\DefaultPreset;
use VladaHejda\AssertException;

class CommandLineOptionsTest extends \PHPUnit_Framework_TestCase
{
    use AssertException;

    public function testCommandLineOptionsShouldThrowOnMissingRulesets()
    {
        $this->assertException(function () {
            new CommandLineOptions(['-', 'src', 'text']);
        }, \InvalidArgumentException::class, CommandLineOptions::INPUT_ERROR);
    }

    public function testCommandLineOptionsShouldThrowOnInvalidInputFileArgs()
    {
        $this->assertException(function () {
            new CommandLineOptions(['-', '--inputfile', '', 'text', 'cleancode']);
        }, \InvalidArgumentException::class);
    }

    public function testCommandLineOptionsShouldThrowOnInvalidInputFileOption()
    {
        $defaults = new \stdClass();
        $defaults->inputfile = uniqid();

        $this->assertException(function () use ($defaults) {
            new CommandLineOptions(['-', 'text', 'cleancode'], [], $defaults);
        }, \InvalidArgumentException::class);
    }

    public function testCommandLineOptionsShouldNotThrowOnValidInputFileOption()
    {
        $defaults = new \stdClass();
        $defaults->inputfile = __DIR__.'/../Fixtures/inputfile.txt';

        new CommandLineOptions(['-', 'text', 'cleancode'], [], $defaults);
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function testCommandLineOptionsShouldNotThrowOnDefaultOptions()
    {
        new CommandLineOptions(['-'], [], DefaultPreset::get());
    }
}
