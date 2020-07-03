<?php

declare(strict_types=1);

namespace HappyHelpers\conditions;

/**
 * @psalm-pure
 *
 * @param mixed $value
 */
function truthy($value): bool
{
    return (bool) $value;
}
