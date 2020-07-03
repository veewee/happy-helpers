<?php

declare(strict_types=1);

namespace HappyHelpers;

/**
 * @psalm-pure
 *
 * @param callable():void $repeated
 */
function repeat(int $times, callable $repeated): void
{
    for ($i = 0; $i < $times; ++$i) {
        $repeated();
    }
}
