<?php

declare(strict_types=1);

namespace HappyHelpers\xml;

use function HappyHelpers\assertions\assertExtensionLoaded;
use function libxml_use_internal_errors;

/**
 * @template A
 *
 * @param callable(): A $run
 * @psalm-return A
 */
function useInternalErrors(callable $run)
{
    assertExtensionLoaded('libxml');

    $previous = libxml_use_internal_errors(true);

    $result = $run();

    libxml_use_internal_errors($previous);

    return $result;
}
