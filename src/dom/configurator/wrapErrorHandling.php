<?php

declare(strict_types=1);

namespace HappyHelpers\dom\configurator;

use DOMDocument;
use function HappyHelpers\xml\detectXmlErrors;

/**
 * @param callable(DOMDocument): DOMDocument $configurator
 *
 * @return callable(DOMDocument): DOMDocument
 */
function wrapErrorHandling(callable $configurator): callable
{
    return static function (DOMDocument $document) use ($configurator): DOMDocument {
        return detectXmlErrors(
            fn (): DOMDocument => $configurator($document)
        );
    };
}
