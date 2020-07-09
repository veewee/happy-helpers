<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

/**
 * @psalm-pure
 * @psalm-template V
 * @psalm-template O
 *
 * @param iterable<array-key, V> $items
 * @param callable(V, array-key): O $mapper
 *
 * @return iterable<array-key, O>
 */
function map(iterable $items, callable $mapper): iterable
{
    foreach ($items as $key => $item) {
        yield $key => $mapper($item, $key);
    }
}
