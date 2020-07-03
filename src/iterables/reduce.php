<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

/**
 * @psalm-pure
 * @psalm-template K of array-key
 * @psalm-template V
 * @psalm-template R
 *
 * @param iterable<K, V> $items
 * @param callable(R, V, K): R $callback
 * @param R $initial
 *
 * @return R
 */
function reduce(iterable $items, callable $callback, $initial)
{
    $result = $initial;
    foreach ($items as $key => $value) {
        $result = $callback($result, $value, $key);
    }

    return $result;
}
