<?php

declare(strict_types=1);

namespace HappyHelpers\dom;

use DOMDocument;
use function HappyHelpers\assertions\assertExtensionLoaded;
use function HappyHelpers\dom\configurator\wrapErrorHandling;

/**
 * @param callable(DOMDocument): DOMDocument $configurator
 */
function document(callable $configurator): DOMDocument
{
    assertExtensionLoaded('dom');

    return wrapErrorHandling($configurator)(new DOMDocument());
}
