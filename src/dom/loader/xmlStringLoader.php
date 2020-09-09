<?php

declare(strict_types=1);

namespace HappyHelpers\dom\loader;

use DOMDocument;

/**
 * @return callable(DOMDocument): bool
 */
function xmlStringLoader(string $xml): callable
{
    return function (DOMDocument $document) use ($xml): bool {
        return (bool) $document->loadXML($xml);
    };
}
