<?php

declare(strict_types=1);

namespace HappyHelpers\callables;

/**
 * @psalm-pure
 * @template O
 *
 * @param callable():O $repeated
 *
 * @return iterable<O>
 */
function repeat(int $times, callable $repeated): iterable
{
    for ($i = 0; $i < $times; ++$i) {
        yield from $repeated();
    }
}
