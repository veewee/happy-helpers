<?php

declare(strict_types=1);

namespace HappyHelpers\dom\validator;

use DOMDocument;
use function HappyHelpers\iterables\map;
use function HappyHelpers\results\result;
use HappyHelpers\results\Types\Failure;
use HappyHelpers\results\Types\Ok;
use HappyHelpers\results\Types\Result;
use HappyHelpers\xml\Exception\XmlErrorsException;
use LibXMLError;

/**
 * TODO : this imports don't work yet. Remove custom types when possible!
 *
 * @psalm-import-type ValidationResult from \HappyHelpers\dom\configurator\withValidator()
 * @psalm-import-type Validator from \HappyHelpers\dom\configurator\withValidator()
 *
 * @psalm-type ValidationResult = Ok<bool>|Failure<XmlErrorsException>
 * @psalm-type Validator = callable(DOMDocument): ValidationResult
 *
 * @param list<Validator> $validators
 *
 * @throws XmlErrorsException
 *
 * @return Validator
 */
function chainedValidator(callable ...$validators): callable
{
    return function (DOMDocument $document) use ($validators): Result {
        /** @var iterable<int, ValidationResult> $results */
        $results = map(
            $validators,
            /**
             * @param Validator $validator
             */
            fn (callable $validator): Result => $validator($document)
        );

        /**
         * @var list<LibXMLError> $errors
         */
        $errors = array_reduce(
            [...$results],
            fn (iterable $list, Result $result): iterable => array_merge(
                [...$list],
                $result->proceed(
                    fn (): array => [],
                    fn (XmlErrorsException $exception): array => $exception->errors()
                )
            ),
            []
        );

        return count($errors) ? result(XmlErrorsException::fromXmlErrors($errors)) : result(true);
    };
}
