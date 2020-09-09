<?php

declare(strict_types=1);

namespace HappyHelpers\dom\configurator;

use DOMDocument;

function utf8(DOMDocument $document): DOMDocument
{
    $document->encoding = 'UTF-8';

    return $document;
}

/**
 * @return callable(DOMDocument): DOMDocument
 */
function withUtf8(): callable
{
    return fn (DOMDocument $document) => utf8($document);
}
