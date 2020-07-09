<?php

declare(strict_types=1);

namespace HappyHelpers\functional;

use function HappyHelpers\conditions\truthy;
use Marcosh\LamPHPda\Maybe;

/**
 * @psalm-pure
 * @template V as mixed|null
 *
 * @param callable(): V $collect
 *
 * @return Maybe<V>
 */
function maybe(callable $collect): Maybe
{
    $result = $collect();

    return truthy($result) ? Maybe::just($result) : Maybe::nothing();
}
