<?php

declare(strict_types=1);

namespace HappyHelpers\dom\validator;

use DOMDocument;
use function HappyHelpers\results\tryResultFrom;
use HappyHelpers\results\Types\Failure;
use HappyHelpers\results\Types\Ok;
use HappyHelpers\results\Types\Result;
use function HappyHelpers\xml\detectXmlErrors;
use HappyHelpers\xml\Exception\XmlErrorsException;

/**
 * @throws XmlErrorsException
 *
 * TODO : this imports don't work yet. Remove custom types when possible!
 * @psalm-import-type ValidationResult from \HappyHelpers\dom\configurator\withValidator()
 * @psalm-import-type Validator from \HappyHelpers\dom\configurator\withValidator()
 *
 * @psalm-type ValidationResult = Ok<bool>|Failure<XmlErrorsException>
 * @psalm-type Validator = callable(DOMDocument): ValidationResult
 *
 * @return Validator
 */
function xsdValidator(string $xsd): callable
{
    /**
     * @return callable(DOMDocument): ValidationResult
     */
    return fn (DOMDocument $document): Result => tryResultFrom(
        fn (): bool => detectXmlErrors(
            fn () => $document->schemaValidate($xsd)
        ),
        XmlErrorsException::class
    );
}
