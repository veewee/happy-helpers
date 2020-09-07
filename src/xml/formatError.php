<?php

declare(strict_types=1);

namespace HappyHelpers\xml;

use LibXMLError;

/**
 * @psalm-pure
 */
function formatError(LibXMLError $error): string
{
    $type = 'none';
    switch ($error->level) {
        case LIBXML_ERR_WARNING:
            $type = 'warning';
            break;
        case LIBXML_ERR_FATAL:
            $type = 'fatal';
            break;
        case LIBXML_ERR_ERROR:
            $type = 'error';
            break;
    }

    return sprintf(
        '[%s] %s: %s (%s) on line %s,%s',
        mb_strtoupper($type),
        $error->file,
        $error->message,
        $error->code ?: 0,
        $error->line,
        $error->column ?: 0
    );
}
