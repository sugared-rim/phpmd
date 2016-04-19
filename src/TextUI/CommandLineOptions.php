<?php

namespace Schnittstabil\Sugared\PHPMD\TextUI;

class CommandLineOptions extends \PHPMD\TextUI\CommandLineOptions
{
    public function __construct(array $args, array $availableRuleSets = array(), $defaults = null)
    {
        if ($defaults === null) {
            $defaults = new \stdClass();
        }

        foreach (get_object_vars($defaults) as $k => $v) {
            switch ($k) {
                case 'inputfile':
                    // prepend inputPath arg
                    $script = array_shift($args);
                    array_unshift($args, $this->inputPath = $this->readInputFile($v));
                    array_unshift($args, $script);
                    break;
                default:
                    $this->$k = $v;
            }
        }

        try {
            parent::__construct($args, $availableRuleSets);
        } catch (\InvalidArgumentException $err) {
            if ($err->getCode() !== self::INPUT_ERROR) {
                throw $err;
            }
        }

        if (empty($this->inputPath) || empty($this->reportFormat) || empty($this->ruleSets)) {
            throw new \InvalidArgumentException($this->usage(), self::INPUT_ERROR);
        }
    }
}
