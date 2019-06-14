<?php

use PhpCsFixer\Config;

$config = new class() extends Config
{
    public function __construct()
    {
        parent::__construct('revealPhp (PHP 7.2)');
        $this->setRiskyAllowed(true);
    }

    public function getRules()
    {
        $rules = [
            '@Symfony' => true,
            'array_syntax' => [
                'syntax' => 'short',
            ],
            'no_unreachable_default_argument_value' => false,
            'braces' => [
                'allow_single_line_closure' => true,
            ],
            'heredoc_to_nowdoc' => false,
            'phpdoc_summary' => false,
            'yoda_style' => false,
            'ordered_imports' => ['sort_algorithm' => 'alpha'],
            'native_function_casing' => false, // To preserve SDL casing
        ];
        return $rules;
    }
};

$config->getFinder()
    ->in([
        __DIR__.'/src',
        __DIR__.'/examples',
    ]);

return $config;
