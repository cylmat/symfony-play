<?php

/**
 * Code
 * @see https://github.com/FriendsOfPHP/PHP-CS-Fixer
 * 
 * Doc
 * @see https://cs.symfony.com/doc/ruleSets
 * 
 * Oliva (v3.11) edition
 */

$rules = [
    '@PSR12' => true,         # @see https://cs.symfony.com/doc/ruleSets/PSR12.html
    '@Symfony' => true,       # @see https://cs.symfony.com/doc/ruleSets/Symfony.html
    # '@PhpCsFixer' => false, # @see https://cs.symfony.com/doc/ruleSets/PhpCsFixer.html

    'array_syntax' => ['syntax' => 'short'],
    'phpdoc_to_comment' => ['ignored_tags' => ['see', 'todo', 'var']],
    'full_opening_tag' => true,
    'echo_tag_syntax' => true,
    'no_useless_else' => true,
    'no_useless_return' => true,
    'php_unit_internal_class' => false,
    'phpdoc_separation' => [
        'groups' => [['deprecated', 'link', 'see', 'since'], ['author', 'copyright', 'license'], ['category', 'package', 'subpackage'], ['property', 'property-read', 'property-write']],
        'skip_unlisted_annotations' => true
    ],

    // ex: use DateTimeImmutable
    'global_namespace_import' => ['import_classes' => true, 'import_constants' => false, 'import_functions' => false],
];

$root = __DIR__.'/../../';
return (new PhpCsFixer\Config())
    ->setRules($rules)
    ->setCacheFile($root.'var/php-cs-fixer.cache')
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in([$root.'src'])
            ->exclude([$root.'vendor'])
    )
;
