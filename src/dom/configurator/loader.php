<?php

declare(strict_types=1);

namespace HappyHelpers\dom\configurator;

use DOMDocument;
use function HappyHelpers\xml\detectXmlErrors;
use HappyHelpers\xml\Exception\XmlErrorsException;
use Webmozart\Assert\Assert;

/**
 * @param callable(DOMDocument): bool $loader
 *
 * @return callable(DOMDocument): DOMDocument
 */
function withLoader(callable $loader): callable
{
    return
        /**
         * @throws \InvalidArgumentException
         * @throws XmlErrorsException
         */
        function (DOMDocument $document) use ($loader): DOMDocument {
            $loaded = detectXmlErrors(fn () => $loader($document));
            Assert::true($loaded, 'Could not load the XML document');

            return $document;
        };
}
