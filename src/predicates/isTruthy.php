<?php

declare(strict_types=1);

namespace HappyHelpers\predicates;

/**
 * @psalm-pure
 *
 * @param mixed $value
 */
function isTruthy($value): bool
{
    return (bool) $value;
}
