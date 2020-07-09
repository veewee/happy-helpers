<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

/**
 * @psalm-pure
 * @psalm-template V
 *
 * @param iterable<array-key, V> $items
 *
 * @return iterable<array-key, V>
 */
function reverse(iterable $items): iterable
{
    yield from array_reverse(toMap($items));
}
