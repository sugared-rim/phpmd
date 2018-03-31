<?php

namespace SugaredRim\PHPMD\TextUI;

use SugaredRim\PHPMD\DefaultPreset;

class CommandLineOptionsTest extends \PHPUnit_Framework_TestCase
{
    public function testCommandLineOptionsShouldThrowOnMissingRulesets()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode(CommandLineOptions::INPUT_ERROR);
        new CommandLineOptions(['-', 'src', 'text']);
    }

    public function testCommandLineOptionsShouldThrowOnInvalidInputFileArgs()
    {
        $this->expectException(\InvalidArgumentException::class);
        new CommandLineOptions(['-', '--inputfile', '', 'text', 'cleancode']);
    }

    public function testCommandLineOptionsShouldThrowOnInvalidInputFileOption()
    {
        $defaults = new \stdClass();
        $defaults->inputfile = uniqid();

        $this->expectException(\InvalidArgumentException::class);
        new CommandLineOptions(['-', 'text', 'cleancode'], [], $defaults);
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
