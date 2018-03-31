<?php

namespace SugaredRim\PHPMD\TextUI;

use Psr\Log\LogLevel;
use Psr\Log\LoggerInterface;
use PHPMD\TextUI\Command;

class ApplicationTest extends \PHPUnit\Framework\TestCase
{
    public function testMainShouldReturnNonZeroOnInvalidInputfile()
    {
        $logger = $this->createMock(LoggerInterface::class);

        $logger->expects($this->once())
            ->method('log')
            ->withConsecutive([
                $this->identicalTo(LogLevel::ERROR),
                $this->matchesRegularExpression('/Input file \'.*\' not exists/i')
            ]);

        $sut = new Application($logger);
        $exitCode = $sut->main([
            '-',
            '--namespace=sugared-rim/phpmd invalid inputfile',
            'tests/Fixtures/empty',
            'text',
            'cleancode',
        ]);

        $this->assertSame(Command::EXIT_EXCEPTION, $exitCode);
    }

    public function testMainShouldReturnSuccessOnDefaults()
    {
        $logger = $this->createMock(LoggerInterface::class);

        $logger->expects($this->never())
            ->method('log');

        $sut = new Application($logger);
        $exitCode = $sut->main([
            '-',
            'tests/Fixtures/empty',
            'text',
            'cleancode',
        ]);

        $this->assertSame(Command::EXIT_SUCCESS, $exitCode);
    }
}
