<?php

declare(strict_types=1);
use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

return
    (new Config())
        ->setCacheFile(__DIR__ . '/var/cache/.php_cs')
        ->setParallelConfig(ParallelConfigFactory::detect())
        ->setFinder(
            Finder::create()
                ->in([
                    __DIR__ . '/bin',
                    __DIR__ . '/config',
                    __DIR__ . '/public',
                    __DIR__ . '/src',
                    __DIR__ . '/tests',
                ])
                ->append([
                    __FILE__,
                ])
        )
        ->setRules([
            '@PSR12' => true,
            '@PSR12:risky' => true,
            '@DoctrineAnnotation' => true,
            '@PHP81Migration' => true,
            '@PHPUnit100Migration:risky' => true,
            '@PhpCsFixer' => true,
            '@PhpCsFixer:risky' => true,

            'ordered_imports' => ['imports_order' => ['class', 'function', 'const']],
            'concat_space' => ['spacing' => 'one'],
            'cast_spaces' => ['space' => 'none'],
            'phpdoc_to_comment' => false,
            'phpdoc_separation' => false,
            'phpdoc_align' => false,
            'binary_operator_spaces' => false,
            'phpdoc_types_order' => ['null_adjustment' => 'always_last'],
            'operator_linebreak' => false,
            'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
            'final_class' => true,
            'final_public_method_for_abstract_class' => true,
            'self_static_accessor' => true,
            'static_lambda' => true,
            'global_namespace_import' => true,
            'fopen_flags' => ['b_mode' => true],
            'yoda_style' => false,
            'blank_line_before_statement' => false,

            'php_unit_strict' => false,
            'php_unit_test_class_requires_covers' => false,
            'php_unit_test_case_static_method_calls' => ['call_type' => 'self'],
        ]);
