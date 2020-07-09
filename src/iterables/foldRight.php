<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

/**
 * @psalm-pure
 * @psalm-template V
 * @psalm-template R
 *
 * @param iterable<array-key, V> $items
 * @param callable(R, V, array-key): R $callback
 * @param R $initial
 *
 * @return R
 */
function foldRight(iterable $items, callable $callback, $initial)
{
    return foldLeft(reverse($items), $callback, $initial);
}
