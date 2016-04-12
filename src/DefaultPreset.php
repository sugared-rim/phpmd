<?php

namespace Schnittstabil\Sugared\PHPMD;

class DefaultPreset
{
    public static function get()
    {
        return [
            'inputPath' => 'src,tests',
            'reportFormat' => 'text',
            'ruleSets' => 'cleancode,codesize,controversial,design,naming,unusedcode',
        ];
    }
}
