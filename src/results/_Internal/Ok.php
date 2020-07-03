<?php

declare(strict_types=1);

namespace HappyHelpers\results\_Internal;

/**
 * @paslm-internal HappyHelpers\results
 * @psalm-immutable
 * @template V
 * @implements ResultInterface<V>
 */
class Ok implements ResultInterface
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

    public function isError(): bool
    {
        return false;
    }

    public function isOk(): bool
    {
        return true;
    }
}
