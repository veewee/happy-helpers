<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

/**
 * @psalm-pure
 * @psalm-template K of array-key
 * @psalm-template V
 *
 * @param iterable<K, V> $items
 * @param callable(V, K): boolean $filter
 *
 * @return iterable<K, V>
 */
function filter(iterable $items, callable $filter): iterable
{
    foreach ($items as $key => $value) {
        if ($filter($value, $key)) {
            yield $key => $value;
        }
    }
}
