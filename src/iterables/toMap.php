<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

/**
 * @psalm-pure
 * @psalm-template V
 *
 * @param iterable<array-key, V> $items
 *
 * @return array<array-key, V>
 */
function toMap(iterable $items): array
{
    return is_array($items) ? $items : iterator_to_array($items, true);
}
