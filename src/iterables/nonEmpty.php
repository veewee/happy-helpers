<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

use function HappyHelpers\conditions\truthy;

/**
 * @psalm-pure
 * @psalm-template K of array-key
 * @psalm-template V
 *
 * @param iterable<K, V> $items
 *
 * @return iterable<K, V>
 */
function nonEmpty(iterable $items): iterable
{
    return filter(
        $items,
        /* @param V $item */
        fn ($item): bool => truthy($item)
    );
}
