<?php

declare(strict_types=1);

namespace HappyHelpers\results\Types;

/**
 * @psalm-immutable
 * @template V
 * @implements Result<V>
 */
final class Ok implements Result
{
    /**
     * @var V
     */
    private $value;

    /**
     * @param V $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return V
     */
    public function value()
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
     * @template C
     *
     * @param callable(V): C $ifOk
     * @param callable(mixed): C $ifFailure
     *
     * @return C
     */
    public function proceed(callable $ifOk, callable $ifFailure)
    {
        return $ifOk($this->value());
    }

    /**
     * @template O
     *
     * @param pure-callable(V):O $f
     *
     * @return Ok<O>
     */
    public function map(callable $f): self
    {
        return new self($f($this->value));
    }
}
