<?php

declare(strict_types=1);

namespace HappyHelpers\results\Types;

/**
 * @psalm-immutable
 * @template T
 */
interface ResultInterface
{
    /**
     * @return (T is \Throwable ? true : false)
     */
    public function isError(): bool;

    /**
     * @return (T is \Throwable ? false : true)
     */
    public function isOk(): bool;

    /**
     * @return T
     */
    public function value();
}
