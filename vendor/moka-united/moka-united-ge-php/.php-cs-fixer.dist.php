<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

$finder = Finder::create()
    ->in(__DIR__ . '/src')
    ->name('*.php')
    ->ignoreVCS(true)
    ->ignoreDotFiles(true);

return (new Config())
    ->setRiskyAllowed(true)
    ->setParallelConfig(ParallelConfigFactory::detect())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'single_quote' => true,
        'no_unused_imports' => true,
        'no_trailing_whitespace' => true,
        'no_whitespace_in_blank_line' => true,
        'no_extra_blank_lines' => ['tokens' => ['extra']],
        'blank_line_before_statement' => ['statements' => ['return']],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'binary_operator_spaces' => ['default' => 'single_space'],
        'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline'],
        'blank_line_after_opening_tag' => true,
    ])
    ->setFinder($finder);
