<?php

declare(strict_types=1);

namespace HappyHelpers\results\Types;

use HappyHelpers\functional\Types\Functor;

/**
 * @psalm-immutable
 * @template R
 * @template T as \Throwable
 * @extends Functor<R>
 */
interface Result extends Functor
{
    public function isFailure(): bool;

    public function isOk(): bool;

    /**
     * @return R|T
     */
    public function value();

    /**
     * @template C
     *
     * @param callable(R): C $ifOk
     * @param callable(T): C $ifFailure
     *
     * @return C
     */
    public function proceed(callable $ifOk, callable $ifFailure);
}
