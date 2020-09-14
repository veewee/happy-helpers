<?php

declare(strict_types=1);

namespace HappyHelpers\results\Types;

use Throwable;

/**
 * @psalm-immutable
 * @template T of \Throwable
 * @implements Result<T>
 */
final class Failure implements Result
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
     * @psalm-suppress ImplementedReturnTypeMismatch
     *
     * @return Failure<T>
     */
    public function map(callable $f): self
    {
        return $this;
    }

    /**
     * @template C
     *
     * @param callable(mixed): C $ifOk
     * @param callable(T): C $ifFailure
     *
     * @return C
     */
    public function proceed(callable $ifOk, callable $ifFailure)
    {
        return $ifFailure($this->value());
    }
}
