<?php

declare(strict_types=1);

namespace HappyHelpers\callables;

use function HappyHelpers\iterables\foldLeft;

/**
 * Performs left-to-right function composition.
 *
 * @psalm-pure
 *
 * @param list<callable(mixed): mixed> $stages
 *
 * @return callable(mixed): mixed
 */
function pipe(callable ...$stages): callable
{
    return fn ($input) => foldLeft(
        $stages,
        /**
         * @template R
         *
         * @param R $input
         * @param callable(R): R $next
         *
         * @return R
         */
        fn ($input, callable $next) => $next($input),
        $input
    );
}
