<?php

declare(strict_types=1);

namespace HappyHelpers\results\_Internal;

use HappyHelpers\results\Types\C;
use HappyHelpers\results\Types\Result;
use Throwable;

/**
 * @psalm-internal HappyHelpers\results
 * @psalm-immutable
 * @ template V of mixed
 * @template T of \Throwable
 * @implements Result<mixed, T>
 */
class Failure implements Result
{
    /**
     * @var T
     */
    private Throwable $value;

    /**
     * @param T $value
     */
    public function __construct(Throwable $value)
    {
        $this->value = $value;
    }

    /**
     * @return T
     */
    public function value(): Throwable
    {
        return $this->value;
    }

    public function isFailure(): bool
    {
        return true;
    }

    public function isOk(): bool
    {
        return false;
    }

    /**
     * @return Failure<T>
     */
    public function map(callable $f): self
    {
        return $this;
    }

    /**
     * @template C
     *
     * @param callable(T): C $ifFailure
     *
     * @return C
     */
    public function proceed(callable $ifOk, callable $ifFailure)
    {
        return $ifFailure($this->value());
    }
}
