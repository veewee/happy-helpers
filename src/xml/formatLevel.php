<?php

declare(strict_types=1);

namespace HappyHelpers\xml;

use LibXMLError;

/**
 * @psalm-pure
 *
 * @return 'warning'|'fatal'|'error'|'none'
 */
function formatLevel(LibXMLError $error): string
{
    switch ($error->level) {
        case LIBXML_ERR_WARNING:
            return 'warning';
        case LIBXML_ERR_FATAL:
            return 'fatal';
            break;
        case LIBXML_ERR_ERROR:
            return 'error';
    }

    return 'none';
}
