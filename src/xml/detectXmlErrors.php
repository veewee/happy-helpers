<?php

declare(strict_types=1);

namespace HappyHelpers\xml;

use HappyHelpers\xml\_Internal\XmlErrorsException;
use function libxml_clear_errors;
use function libxml_get_errors;
use LibXMLError;

/**
 * @template A
 *
 * @param callable(): A $run
 * @psalm-return A
 */
function detectXmlErrors(callable $run)
{
    return useInternalErrors(
        /**
         * @throws XmlErrorsException
         */
        static function () use ($run) {
            libxml_clear_errors();
            $result = $run();

            /** @var list<LibXMLError> $errors */
            $errors = libxml_get_errors();
            libxml_clear_errors();

            if ($errors) {
                throw XmlErrorsException::fromXmlErrors($errors);
            }

            return $result;
        }
    );
}
