<?php

declare(strict_types=1);

namespace HappyHelpers\dom\configurator;

use DOMDocument;
use HappyHelpers\results\Types\Result;
use HappyHelpers\xml\_Internal\XmlErrorsException;
use Webmozart\Assert\Assert;

/**
 * @param callable(DOMDocument): Result<bool, \Throwable> $validator
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
                static function (\Throwable $exception): DOMDocument {
                    throw $exception;
                }
            );
        };
}
