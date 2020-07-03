<?php

declare(strict_types=1);

namespace HappyHelpers\callables;

/**
 * @psalm-pure
 *
 * @param list<callable(mixed): mixed> $stages
 *
 * @return callable(mixed): mixed
 */
function pipe(callable ...$stages): callable
{
    return fn ($input) => array_reduce(
        $stages,
        /**
         * @template I
         * @template O
         *
         * @param I $input
         * @param callable(I): O $next
         *
         * @return O
         */
        fn ($input, callable $next) => $next($input),
        $input
    );
}
