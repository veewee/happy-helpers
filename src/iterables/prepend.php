<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

/**
 * @psalm-pure
 * @template V
 *
 * @param iterable<array-key, V> $items
 * @param list<V> $new
 *
 * @return iterable<array-key, V>
 */
function prepend(iterable $items, ...$new): iterable
{
    yield from $new;
    yield from $items;
}
