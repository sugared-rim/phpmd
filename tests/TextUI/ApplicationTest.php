<?php

namespace SugaredRim\PHPMD\TextUI;

use Gamez\Psr\Log\TestLoggerTrait;
use PHPMD\TextUI\Command;
use VladaHejda\AssertException;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    use TestLoggerTrait;

    protected $logger;

    protected function setUp()
    {
        $this->logger = $this->getTestLogger();
    }

    public function testMainShouldReturnNonZeroOnInvalidInputfile()
    {
        $sut = new Application($this->logger);
        $exitCode = $sut->main([
            '-',
            '--namespace=sugared-rim/phpmd invalid inputfile',
            'tests/Fixtures/empty',
            'text',
            'cleancode',
        ]);
        $log = implode(PHP_EOL, $this->logger->getRecords());

        $this->assertSame(Command::EXIT_EXCEPTION, $exitCode);
        $this->assertRegexp('/error Input file \'.*\' not exists/i', $log);
    }

    public function testMainShouldReturnSuccessOnDefaults()
    {
        $sut = new Application($this->logger);
        $exitCode = $sut->main([
            '-',
            'tests/Fixtures/empty',
            'text',
            'cleancode',
        ]);
        $log = implode(PHP_EOL, $this->logger->getRecords());

        $this->assertSame(Command::EXIT_SUCCESS, $exitCode);
        $this->assertSame('', $log);
    }
}
