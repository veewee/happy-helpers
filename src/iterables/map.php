<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

use HappyHelpers\functional\Types\Functor;

/**
 * @psalm-pure
 * @template V
 * @template O
 *
 * @param iterable<array-key, V> $items
 * @param callable(V): O $mapper
 *
 * @return iterable<array-key, O|Functor<O>>
 */
function map(iterable $items, callable $mapper): iterable
{
    foreach ($items as $key => $item) {
        if ($item instanceof Functor) {
            yield $key => $item->map($mapper);
            continue;
        }

        yield $key => $mapper($item);
    }
}
