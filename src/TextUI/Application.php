<?php

namespace SugaredRim\PHPMD\TextUI;

use PHPMD\RuleSetFactory;
use PHPMD\TextUI\Command;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Schnittstabil\ComposerExtra\ComposerExtra;

class Application
{
    protected $defaultNamespace = 'sugared-rim/phpmd';
    protected $defaultConfig;
    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        $this->defaultConfig = new \stdClass();
        $this->defaultConfig->presets = [
            'SugaredRim\\PHPMD\\DefaultPreset::get',
        ];
    }

    protected function getConfig($namespace)
    {
        return (new ComposerExtra(
            $namespace,
            $this->defaultConfig,
            'presets'
        ))->get();
    }

    protected function parseSugaredArgv(array $args)
    {
        $options = [
            'namespace' => $this->defaultNamespace,
        ];

        foreach ($args as $k => &$v) {
            if (substr($v, 0, 12) === '--namespace=') {
                $options['namespace'] = substr($v, 12);
                unset($args[$k]);
            }
        }

        $options['args'] = $args;

        return $options;
    }

    protected function runCommand(array $args)
    {
        $argv = $this->parseSugaredArgv($args);
        $config = $this->getConfig($argv['namespace']);
        $ruleSetFactory = new RuleSetFactory();
        $options = new CommandLineOptions(
            $argv['args'],
            $ruleSetFactory->listAvailableRuleSets(),
            $config
        );
        $command = new Command();

        return $command->run($options, $ruleSetFactory);
    }

    protected function log($level, $message)
    {
        // @codeCoverageIgnoreStart
        if ($this->logger === null) {
            $message = sprintf('[%s] %s %s', date('Y-m-d H:i:s'), strtoupper($level), $message);
            echo $message;
            flush();
            return;
        }
        // @codeCoverageIgnoreEnd
        $this->logger->log($level, $message);
    }

    public function main(array $args)
    {
        try {
            $exitCode = $this->runCommand($args);
        } catch (\Exception $e) {
            $this->log(LogLevel::ERROR, $e->getMessage());
            $exitCode = Command::EXIT_EXCEPTION;
        }

        return $exitCode;
    }
}
