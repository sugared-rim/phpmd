<?php

namespace Schnittstabil\Sugared\PHPMD;

class DefaultPreset
{
    public static function get()
    {
        $config = new \stdClass();
        $config->inputPath = 'src,tests';
        $config->reportFormat = 'text';
        $config->ruleSets = 'cleancode,codesize,controversial,design,naming,unusedcode';

        return $config;
    }
}
