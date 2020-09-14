<?php

declare(strict_types=1);

namespace HappyHelpers\dom;

use DOMDocument;
use DOMNode;
use function HappyHelpers\callables\after;
use function HappyHelpers\dom\configurator\withLoader;
use function HappyHelpers\dom\loader\xmlNodeLoader;

/**
 * @param callable(DOMDocument): DOMDocument $configurator
 */
function documentFromNode(DOMNode $importedNode, callable $configurator): DOMDocument
{
    return document(
        after(
            withLoader(xmlNodeLoader($importedNode)),
            $configurator
        )
    );
}
