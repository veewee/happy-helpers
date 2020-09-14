<?php

declare(strict_types=1);

namespace HappyHelpers\results\Types;

use HappyHelpers\functional\Types\Functor;

/**
 * @psalm-immutable
 * @template R
 * @extends Functor<R>
 */
interface Result extends Functor
{
    public function isFailure(): bool;

    public function isOk(): bool;

    /**
     * @return R
     */
    public function value();

    /**
     * @template C
     *
     * @param callable(mixed): C $ifOk
     * @param callable(mixed): C $ifFailure
     *
     * @return C
     */
    public function proceed(callable $ifOk, callable $ifFailure);
}
