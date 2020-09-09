<?php

declare(strict_types=1);

namespace HappyHelpers\dom;

use DOMDocument;
use function HappyHelpers\callables\after;
use function HappyHelpers\dom\configurator\withLoader;
use function HappyHelpers\dom\loader\xmlFileLoader;

/**
 * @param callable(DOMDocument): DOMDocument $configurator
 */
function documentFromXmlFile(string $file, callable $configurator): DOMDocument
{
    return document(
        after(
            withLoader(xmlFileLoader($file)),
            $configurator
        )
    );
}
