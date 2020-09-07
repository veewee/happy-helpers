<?php

declare(strict_types=1);

namespace HappyHelpers\xml\_Internal;

use function HappyHelpers\iterables\map;
use function HappyHelpers\strings\stringFromIterable;
use function HappyHelpers\xml\formatError;
use LibXMLError;
use Webmozart\Assert\Assert;

/**
 * @internal
 * @psalm-readonly
 */
class XmlErrorsException extends \RuntimeException
{
    /**
     * @var list<LibXMLError>
     */
    private array $errors;

    private function __construct(array $errors)
    {
        Assert::allIsInstanceOf($errors, LibXMLError::class);
        $this->errors = $errors;

        parent::__construct(
            stringFromIterable(
                map(
                    $errors,
                    fn (LibXMLError $error): string => formatError($error)
                ),
                PHP_EOL
            )
        );
    }

    /**
     * @param list<LibXMLError> $errors
     */
    public static function fromXmlErrors(array $errors): self
    {
        return new self($errors);
    }

    /**
     * @param list<LibXMLError> $errors
     */
    public function errors(): array
    {
        return $this->errors;
    }
}
