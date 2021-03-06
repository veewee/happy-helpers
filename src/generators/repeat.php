<?php

declare(strict_types=1);

namespace HappyHelpers\generators;

/**
 * @psalm-pure
 * @template O
 *
 * @param pure-callable():O $repeated
 *
 * @return iterable<O>
 */
function repeat(int $times, callable $repeated): iterable
{
    for ($i = 0; $i < $times; ++$i) {
        yield $repeated();
    }
}
