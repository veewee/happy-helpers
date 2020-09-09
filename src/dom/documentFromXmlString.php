<?php

declare(strict_types=1);

namespace HappyHelpers\dom;

use DOMDocument;
use function HappyHelpers\callables\after;
use function HappyHelpers\dom\configurator\withLoader;
use function HappyHelpers\dom\loader\xmlStringLoader;

/**
 * @param callable(DOMDocument): DOMDocument $configurator
 */
function documentFromXmlString(string $xml, callable $configurator): DOMDocument
{
    return document(
        after(
            withLoader(xmlStringLoader($xml)),
            $configurator
        )
    );
}
