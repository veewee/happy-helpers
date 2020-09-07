<?php

declare(strict_types=1);

namespace HappyHelpers\dom;

use DOMDocument;
use function HappyHelpers\callables\after;
use Webmozart\Assert\Assert;

/**
 * @param callable(DOMDocument): DOMDocument $configurator
 */
function documentFromFile(string $file, callable $configurator): DOMDocument
{
    Assert::fileExists($file);

    return document(
        after(
            static function (DOMDocument $document) use ($file): DOMDocument {
                Assert::true($document->load($file), 'Could not load '.$file);

                return $document;
            },
            $configurator
        )
    );
}
