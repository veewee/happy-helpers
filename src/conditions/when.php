<?php

declare(strict_types=1);

namespace HappyHelpers\conditions;

/**
 * @psalm-pure
 * @template V
 *
 * @param mixed $value
 * @param callable(): V $result
 * @param V|null $fallback
 *
 * @return V
 */
function when($value, callable $result, $fallback = null)
{
    return truthy($value) ? $result($value) : $fallback;
}
