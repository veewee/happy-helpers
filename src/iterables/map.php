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
 * @param callable(V, K): O $mapper
 *
 * @return iterable<K, O>
 */
function map(iterable $items, callable $mapper): iterable
{
    foreach ($items as $key => $item) {
        yield $key => $mapper($item, $key);
    }
}
