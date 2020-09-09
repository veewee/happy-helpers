<?php

declare(strict_types=1);

namespace HappyHelpers\dom\loader;

use DOMDocument;
use Webmozart\Assert\Assert;

/**
 * @return callable(DOMDocument): bool
 */
function xmlFileLoader(string $file): callable
{
    return function (DOMDocument $document) use ($file): bool {
        Assert::fileExists($file);

        return (bool) $document->load($file);
    };
}
