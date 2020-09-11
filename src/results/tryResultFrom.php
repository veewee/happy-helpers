<?php

declare(strict_types=1);

namespace HappyHelpers\results;

use HappyHelpers\results\_Internal\Failure;
use HappyHelpers\results\_Internal\Ok;
use HappyHelpers\results\Types\Result;
use Throwable;

/**
 * @template V as mixed
 *
 * @param callable(): V $callback
 *
 * @return Result<V, Throwable>
 */
function tryResultFrom(callable $callback): Result
{
    try {
        return new Ok($callback());
    } catch (Throwable $exception) {
        return new Failure($exception);
    }
}
