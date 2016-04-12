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
        $this->assertException(function () {
            new CommandLineOptions(['-', 'text', 'cleancode'], [], ['inputfile' => uniqid()]);
        }, \InvalidArgumentException::class);
    }

    public function testCommandLineOptionsShouldNotThrowOnValidInputFileOption()
    {
        new CommandLineOptions(['-', 'text', 'cleancode'], [], ['inputfile' => __DIR__.'/../Fixtures/inputfile.txt']);
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function testCommandLineOptionsShouldNotThrowOnDefaultOptions()
    {
        new CommandLineOptions(['-'], [], DefaultPreset::get());
    }
}
