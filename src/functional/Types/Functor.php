<?php

declare(strict_types=1);

namespace HappyHelpers\functional\Types;

/**
 * @template V
 */
interface Functor
{
    /**
     * @template B
     * @psalm-param pure-callable(V): B $mapper
     *
     * @psalm-return Functor<B>
     * @psalm-pure
     */
    public function map(callable $mapper);
}
