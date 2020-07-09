<?php

declare(strict_types=1);

namespace HappyHelpers\conditions;

use function HappyHelpers\functional\maybe;

/**
 * @psalm-pure
 * @template I as mixed|null
 * @template O as mixed|null
 *
 * @param I $value
 * @param callable(I): O $collect
 * @param O $fallback
 *
 * @return O
 */
function when($value, callable $collect, $fallback = null)
{
    return maybe(
        fn () => $value
    )->eval(
        $fallback,
        /**
         * @param I $just
         *
         * @return O
         */
        fn ($just) => $collect($just)
    );
}
