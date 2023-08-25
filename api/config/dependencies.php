<?php

declare(strict_types=1);

$files = array_merge(
    glob(__DIR__ . '/common/*.php') ?: [],
    glob(__DIR__ . '/' . (getenv('APP_ENV') ?: 'prod') . '/*.php') ?: []
);

$configs = array_map(
    static function (string $file): array {
        /**
         * @var array
         * @psalm-suppress UnresolvableInclude
         */
        return require $file;
    },
    $files
);
/** @psalm-suppress InvalidScalarArgument */
return array_replace_recursive(...$configs);
