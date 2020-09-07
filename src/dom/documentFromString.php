<?php

declare(strict_types=1);

namespace HappyHelpers\dom;

use DOMDocument;
use function HappyHelpers\callables\after;
use Webmozart\Assert\Assert;

/**
 * @param callable(DOMDocument): DOMDocument $configurator
 */
function documentFromString(string $xml, callable $configurator): DOMDocument
{
    return document(
        after(
            static function (DOMDocument $document) use ($xml): DOMDocument {
                Assert::true($document->loadXML($xml), 'Could not load XML string');

                return $document;
            },
            $configurator
        )
    );
}
