<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

/**
 * @psalm-suppress ImpureMethodCall
 *
 * @psalm-pure
 * @psalm-template V
 * @psalm-template R
 *
 * @param iterable<array-key, V> $items
 * @param pure-callable(R, V, array-key): R $callback
 * @param R $initial
 *
 * @return R
 */
function foldLeft(iterable $items, callable $callback, $initial)
{
    $result = $initial;
    foreach ($items as $key => $value) {
        $result = $callback($result, $value, $key);
    }

    return $result;
}
