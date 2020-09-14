<?php

declare(strict_types=1);

namespace HappyHelpers\dom\locator;

use DOMDocument;
use function Safe\preg_split;

/**
 * @return iterable<int, string>
 */
function xsdNamespacedSchemaLocator(DOMDocument $document): iterable
{
    $schemaNs = 'http://www.w3.org/2001/XMLSchema-instance';
    $attributes = $document->documentElement->attributes;

    if ($schemaLocation = $attributes->getNamedItemNS($schemaNs, 'schemaLocation')) {
        /** @var list<string> $parts */
        $parts = preg_split('/\s+/', trim($schemaLocation->textContent));
        foreach ($parts as $key => $value) {
            if ($key & 1) {
                yield $value;
            }
        }
    }
}

/**
 * @return iterable<int, string>
 */
function xsdNotNamespacedSchemaLocator(DOMDocument $document): iterable
{
    $schemaNs = 'http://www.w3.org/2001/XMLSchema-instance';
    $attributes = $document->documentElement->attributes;

    if ($schemaLocNoNamespace = $attributes->getNamedItemNS($schemaNs, 'noNamespaceSchemaLocation')) {
        yield from preg_split('/\s+/', trim($schemaLocNoNamespace->textContent));
    }
}

/**
 * @return iterable<int, string>
 */
function xsdSchemaLocator(DOMDocument $document): iterable
{
    yield from xsdNamespacedSchemaLocator($document);
    yield from xsdNotNamespacedSchemaLocator($document);
}
