<?php

declare(strict_types=1);

namespace HappyHelpers\results;

use HappyHelpers\results\_Internal\Failure;
use HappyHelpers\results\_Internal\Ok;
use HappyHelpers\results\_Internal\ResultInterface;
use Throwable;

/**
 * @psalm-pure
 * @template V
 *
 * @param V $value
 *
 * @return ResultInterface<V>
 */
function result($value): ResultInterface
{
    return $value instanceof Throwable ? new Failure($value) : new Ok($value);
}
