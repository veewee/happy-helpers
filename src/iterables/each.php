<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

/**
 * @psalm-pure
 * @psalm-template K of array-key
 * @psalm-template V
 * @psalm-template O
 *
 * @param iterable<K, V> $items
 * @param callable(V, K) $walker
 */
function each(iterable $items, callable $walker): void
{
    foreach ($items as $key => $item) {
        $walker($item, $key);
    }
}
