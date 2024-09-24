<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = (new Finder())
    ->in([__DIR__ . '/src', __DIR__ . '/tests'])
;

return (new Config())
    ->setRiskyAllowed(false)
    ->setRules([
        '@PSR2' => true,
        '@Symfony' => true,
        '@PhpCsFixer' => true,
        'array_syntax' => ['syntax' => 'short'],
        'cast_spaces' => ['space' => 'none'],
        'concat_space' => ['spacing' => 'one'],
        'yoda_style' => false,
        'ordered_class_elements' => false,
        'ordered_imports' => false,
        'blank_line_before_statement' => false,
        'phpdoc_align' => ['align' => 'left'],
        'phpdoc_var_without_name' => false,
        'phpdoc_types_order' => false,
        'phpdoc_order' => false,
        'phpdoc_separation' => false,
        'class_definition' => false,
        'ternary_to_null_coalescing' => true,
        'php_unit_test_class_requires_covers' => false,
        'php_unit_internal_class' => false,
        'no_unused_imports' => true,
        'nullable_type_declaration_for_default_null_value' => false,
        'fully_qualified_strict_types' => false,
        'single_line_empty_body' => false,
        'no_superfluous_phpdoc_tags' => false,
        'phpdoc_trim' => false,
    ])
    ->setFinder($finder);
