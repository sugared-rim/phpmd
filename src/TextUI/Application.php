<?php

namespace Schnittstabil\Sugared\PHPMD\TextUI;

use fool\echolog\Echolog;
use PHPMD\RuleSetFactory;
use PHPMD\TextUI\Command;
use Psr\Log\LoggerInterface;
use Schnittstabil\ComposerExtra\ComposerExtra;

class Application
{
    protected $defaultNamespace = 'schnittstabil/sugared-phpmd';
    protected $defaultConfig;
    protected $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        // @codeCoverageIgnoreStart
        if ($logger === null) {
            $logger = new Echolog();
        }
        // @codeCoverageIgnoreEnd
        $this->logger = $logger;
        $this->defaultConfig = new \stdClass();
        $this->defaultConfig->presets = [
            'Schnittstabil\\Sugared\\PHPMD\\DefaultPreset::get',
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

    public function main(array $args)
    {
        try {
            $exitCode = $this->runCommand($args);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $exitCode = Command::EXIT_EXCEPTION;
        }

        return $exitCode;
    }
}
