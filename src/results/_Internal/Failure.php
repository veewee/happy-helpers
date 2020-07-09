<?php

declare(strict_types=1);

namespace HappyHelpers\results\_Internal;

use HappyHelpers\results\Types\ResultInterface;
use Throwable;

/**
 * @paslm-internal HappyHelpers\results
 * @psalm-immutable
 * @template F of \Throwable
 * @implements ResultInterface<F>
 */
class Failure implements ResultInterface
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

    public function isError(): bool
    {
        return false;
    }

    public function isOk(): bool
    {
        return true;
    }
}
