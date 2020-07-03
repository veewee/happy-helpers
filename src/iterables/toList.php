<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

/**
 * @psalm-pure
 * @psalm-template V
 *
 * @param iterable<mixed, V> $items
 *
 * @return list<V>
 */
function toList(iterable $items): array
{
    return array_values(is_array($items) ? $items : iterator_to_array($items, false));
}
