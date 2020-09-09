<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

/**
 * @psalm-suppress ImpureMethodCall
 *
 * @psalm-pure
 * @psalm-template V
 *
 * @param iterable<array-key, V> $items
 * @param pure-callable(V, array-key): boolean $filter
 *
 * @return iterable<array-key, V>
 */
function filter(iterable $items, callable $filter): iterable
{
    foreach ($items as $key => $value) {
        if ($filter($value, $key)) {
            yield $key => $value;
        }
    }
}
