<?php

declare(strict_types=1);

namespace HappyHelpers\iterables;

/**
 * @psalm-pure
 */
function join(iterable $items, string $glue): string
{
    return implode($glue, toList($items));
}
