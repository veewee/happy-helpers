<?php

declare(strict_types=1);

namespace HappyHelpers\results;

use HappyHelpers\results\Types\Failure;
use HappyHelpers\results\Types\Ok;
use HappyHelpers\results\Types\Result;
use function is_a;
use Throwable;

/**
 * @template V as mixed
 * @template F as Throwable
 *
 * @param callable(): V $callback
 * @param class-string<F> $expectedException
 *
 * @throws Throwable
 *
 * @return Failure<F>|Ok<V>
 */
function tryResultFrom(callable $callback, string $expectedException = Throwable::class): Result
{
    try {
        return new Ok($callback());
    } catch (Throwable $exception) {
        if (!is_a($exception, $expectedException)) {
            throw $exception;
        }

        return new Failure($exception);
    }
}
