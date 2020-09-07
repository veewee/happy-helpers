<?php

declare(strict_types=1);

namespace HappyHelpers\results;

use HappyHelpers\results\_Internal\Failure;
use HappyHelpers\results\_Internal\Ok;
use HappyHelpers\results\Types\Result;
use Throwable;

/**
 * @psalm-pure
 * @template V as mixed
 *
 * @param V $value
 *
 * @return Result<(V is \Throwable ? null : V), (V is \Throwable ? V : null)>
 */
function result($value): Result
{
    return $value instanceof Throwable ? new Failure($value) : new Ok($value);
}
