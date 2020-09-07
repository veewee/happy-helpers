<?php

declare(strict_types=1);

namespace HappyHelpers\results\_Internal;

use HappyHelpers\results\Types\Result;

/**
 * @paslm-internal HappyHelpers\results
 * @psalm-readonly
 * @template V
 * @implements Result<V, null>
 */
class Ok implements Result
{
    /**
     * @var V
     */
    private $value;

    /**
     * @psalm-pure
     *
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
     * @psalm-pure
     * @template C
     *
     * @param callable(V): C $ifOk
     *
     * @return C
     */
    public function proceed(callable $ifOk, callable $ifFailure)
    {
        return $ifOk($this->value());
    }

    /**
     * @psalm-pure
     * @template O
     *
     * @param callable(V):O $f
     *
     * @return Ok<O>
     */
    public function map(callable $f): self
    {
        return new self($f($this->value));
    }
}
