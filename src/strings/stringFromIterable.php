<?php

declare(strict_types=1);

namespace HappyHelpers\strings;

use function HappyHelpers\iterables\toList;

/**
 * @psalm-pure
 */
function stringFromIterable(iterable $items, string $glue): string
{
    return implode($glue, toList($items));
}
