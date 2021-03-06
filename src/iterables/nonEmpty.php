<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

use function HappyHelpers\predicates\isTruthy;

/**
 * @psalm-pure
 * @psalm-template V
 *
 * @param iterable<array-key, V> $items
 *
 * @return iterable<array-key, V>
 */
function nonEmpty(iterable $items): iterable
{
    return filter(
        $items,
        /** @param V $item */
        fn ($item): bool => isTruthy($item)
    );
}
