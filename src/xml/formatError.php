<?php

declare(strict_types=1);

namespace HappyHelpers\xml;

use LibXMLError;

/**
 * @psalm-pure
 */
function formatError(LibXMLError $error): string
{
    return sprintf(
        '[%s] %s: %s (%s) on line %s,%s',
        mb_strtoupper(formatLevel($error)),
        $error->file,
        $error->message,
        $error->code ?: 0,
        $error->line,
        $error->column ?: 0
    );
}
