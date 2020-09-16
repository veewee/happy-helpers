<?php

declare(strict_types=1);

namespace HappyHelpers\dom\loader;

use DOMDocument;
use DOMNode;
use function HappyHelpers\dom\manipulator\appendExternalNode;

/**
 * @return callable(DOMDocument): bool
 */
function xmlNodeLoader(DOMNode $importedNode): callable
{
    return fn (DOMDocument $document): bool => (bool) appendExternalNode($importedNode, $document);
}
