<?php

declare(strict_types=1);

namespace HappyHelpers\results\Types;

use HappyHelpers\functional\Types\Functor;

/**
 * @psalm-readonly
 * @template R | null
 * @template T as \Throwable|null
 *
 * @extends Functor<R>
 */
interface Result extends Functor
{
    /**
     * @return (T is \Throwable ? true : false)
     */
    public function isFailure(): bool;

    /**
     * @return (T is \Throwable ? false : true)
     */
    public function isOk(): bool;

    /**
     * @return (T is \Throwable ? T : R)
     */
    public function value();

    /**
     * @psalm-pure
     * @template C
     *
     * @param callable(R): C $ifOk
     * @param callable(T): C $ifFailure
     *
     * @return C
     */
    public function proceed(callable $ifOk, callable $ifFailure);
}
