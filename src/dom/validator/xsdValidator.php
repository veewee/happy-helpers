<?php

declare(strict_types=1);

namespace HappyHelpers\dom\validator;

use DOMDocument;
use function HappyHelpers\results\tryResultFrom;
use HappyHelpers\results\Types\Result;
use HappyHelpers\xml\_Internal\XmlErrorsException;
use function HappyHelpers\xml\detectXmlErrors;

/**
 * @throws XmlErrorsException
 *
 * @return callable(DOMDocument): Result<bool, \Throwable>
 */
function xsdValidator(string $xsd): callable
{
    return fn (DOMDocument $document): Result => tryResultFrom(
        fn (): bool => detectXmlErrors(
            fn () => $document->schemaValidate($xsd)
        )
    );
}
