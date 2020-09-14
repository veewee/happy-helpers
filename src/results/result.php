<?php

declare(strict_types=1);

namespace HappyHelpers\results;

use HappyHelpers\results\Types\Failure;
use HappyHelpers\results\Types\Ok;
use HappyHelpers\results\Types\Result;
use Throwable;

/**
 * @psalm-pure
 * @template V as mixed
 *
 * @param V $value
 *
 * @return (V is Throwable ? Failure<V&Throwable> : Ok<V>)
 */
function result($value): Result
{
    return $value instanceof Throwable ? new Failure($value) : new Ok($value);
}
