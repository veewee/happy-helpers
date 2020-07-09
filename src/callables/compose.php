<?php

declare(strict_types=1);

namespace HappyHelpers\callables;

use function HappyHelpers\iterables\foldRight;

/**
 * Performs right-to-left function composition.
 *
 * @psalm-pure
 *
 * @param list<callable(mixed): mixed> $stages
 *
 * @return callable(mixed): mixed
 */
function compose(callable ...$stages): callable
{
    return fn ($input) => foldRight(
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
