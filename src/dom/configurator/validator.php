<?php

declare(strict_types=1);

namespace HappyHelpers\dom\configurator;

use DOMDocument;
use HappyHelpers\results\Types\Failure;
use HappyHelpers\results\Types\Ok;
use HappyHelpers\results\Types\Result;
use HappyHelpers\xml\Exception\XmlErrorsException;
use Webmozart\Assert\Assert;

/**
 * @psalm-type ValidationResult = Ok<bool>|Failure<XmlErrorsException>
 * @psalm-type Validator = callable(DOMDocument): ValidationResult
 *
 * @param Validator $validator
 *
 * @throws XmlErrorsException
 *
 * @return callable(DOMDocument): DOMDocument
 */
function withValidator(callable $validator): callable
{
    return
        /**
         * @throws XmlErrorsException
         */
        function (DOMDocument $document) use ($validator): DOMDocument {
            $result = $validator($document);
            Assert::isInstanceOf($result, Result::class);

            return $result->proceed(
                fn (): DOMDocument => $document,
                static function (XmlErrorsException $exception): DOMDocument {
                    throw $exception;
                }
            );
        };
}
