<?php

declare(strict_types=1);

namespace HappyHelpers\callables;

/**
 * @psalm-pure
 *
 * @template I
 * @template O
 * @template R
 *
 * @param callable(I): O $first
 * @param callable(O): R $next
 *
 * @return callable(I): R
 */
function combine(callable $first, callable $next): callable
{
    return fn ($input) => $next($first($input));
}
