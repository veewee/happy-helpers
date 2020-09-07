<?php

declare(strict_types=1);

namespace HappyHelpers\results\_Internal;

use HappyHelpers\results\Types\C;
use HappyHelpers\results\Types\Result;
use Throwable;

/**
 * @paslm-internal HappyHelpers\results
 * @psalm-immutable
 * @template F of \Throwable
 * @implements Result<null, F>
 */
class Failure implements Result
{
    /**
     * @var F
     */
    private Throwable $value;

    /**
     * @param F $value
     */
    public function __construct(Throwable $value)
    {
        $this->value = $value;
    }

    /**
     * @return F
     */
    public function value(): Throwable
    {
        return $this->value;
    }

    public function isFailure(): bool
    {
        return false;
    }

    public function isOk(): bool
    {
        return true;
    }

    /**
     * @return Failure<F>
     */
    public function map(callable $f): self
    {
        return $this;
    }

    /**
     * @template C
     *
     * @param callable(F): C $ifFailure
     *
     * @return C
     */
    public function proceed(callable $ifOk, callable $ifFailure)
    {
        return $ifFailure($this->value());
    }
}
