<?php

declare(strict_types=1);

namespace HappyHelpers\predicates;

/**
 * @psalm-pure
 * @template I as mixed|null
 * @template O as mixed|null
 *
 * @param I $value
 * @param pure-callable(I): O $collect
 * @param pure-callable(): O $fallback
 *
 * @return O
 */
function when($value, callable $collect, callable $fallback)
{
    return $value ? $collect($value) : $fallback();
}
