<?php

namespace LaravelReady\ReadableNumbers\Directives;

use LaravelReady\ReadableNumbers\Services\ReadableNumbers;

class NumberDirectives
{
    public $directives;

    public function __construct()
    {
        $this->directives = [
            'readableNumber' => function ($args) {
                $args = $this->getDirectiveArguments($args);

                $args[1] = $args[1] ?? 1;
                $args[2] = $args[2] ?? null;

                return ReadableNumbers::make($args[0], $args[1], $args[2]);
            },
        ];
    }

    /**
     * Extract blade directive arguments as array
     *
     * @param string $args
     *
     * @return array
     */
    private function getDirectiveArguments(string $args): array
    {
        return explode(',', str_replace(['(', ')', ' ', "'"], '', $args));
    }
}
