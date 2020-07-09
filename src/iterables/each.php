<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

/**
 * @psalm-pure
 * @psalm-template V
 * @psalm-template O
 *
 * @param iterable<array-key, V> $items
 * @param callable(V, array-key) $walker
 */
function each(iterable $items, callable $walker): void
{
    foreach ($items as $key => $item) {
        $walker($item, $key);
    }
}
