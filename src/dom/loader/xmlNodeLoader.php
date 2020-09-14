<?php

declare(strict_types=1);

namespace HappyHelpers\dom\loader;

use DOMDocument;
use DOMNode;

/**
 * @return callable(DOMDocument): bool
 */
function xmlNodeLoader(DOMNode $importedNode): callable
{
    return function (DOMDocument $document) use ($importedNode): bool {
        $copy = $document->importNode($importedNode, true);
        if (!$copy) {
            return false;
        }

        $document->appendChild($copy);

        return true;
    };
}
