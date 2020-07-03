<?php

declare(strict_types=1);

namespace HappyHelpers;

/**
 * @psalm-pure
 * @template V
 *
 * @param V $item
 *
 * @return V
 */
function identity($item)
{
    return $item;
}
