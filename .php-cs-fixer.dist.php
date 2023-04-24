<?php


$finder = (new PhpCsFixer\Finder())
    ->in([__DIR__ . '/src', __DIR__ . '/tests']);

return (new PhpCsFixer\Config())
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
        //'method_argument_space' => null,
        //'no_whitespace_in_blank_line' => null,
        //'no_extra_blank_lines' => null,
        //'braces' => null,
        'blank_line_before_statement' => false,
        'phpdoc_align' => ['align' => 'left'],
        'phpdoc_var_without_name' => false,
        'phpdoc_types_order' => false,
        'phpdoc_order' => false,
        'phpdoc_separation' => false,
        //'no_superfluous_elseif' => null,
        'class_definition' => false,
        'ternary_to_null_coalescing' => true,
        'php_unit_test_class_requires_covers' => false,
        'php_unit_internal_class' => false,
    ])
    ->setFinder($finder);