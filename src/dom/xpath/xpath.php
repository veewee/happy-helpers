<?php

declare(strict_types=1);

namespace HappyHelpers\dom\xpath;

use DOMDocument;
use DOMXPath;

function xpath(DOMDocument $document, array $namespaces): DOMXPath
{
    $xpath = new DOMXPath($document);
    foreach ($namespaces as $prefix => $namespaceURI) {
        $xpath->registerNamespace($prefix, $namespaceURI);
    }

    return $xpath;
}