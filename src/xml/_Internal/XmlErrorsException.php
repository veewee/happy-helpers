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
 * @psalm-immutable
 * @psalm-suppress MissingImmutableAnnotation
 */
class XmlErrorsException extends \RuntimeException
{
    /**
     * @var non-empty-list<LibXMLError>
     */
    private array $errors;

    /**
     * @param non-empty-list<LibXMLError> $errors
     */
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
     * @param non-empty-list<LibXMLError> $errors
     */
    public static function fromXmlErrors(array $errors): self
    {
        return new self($errors);
    }

    /**
     * @param non-empty-list<LibXMLError> $errors
     */
    public function errors(): array
    {
        return $this->errors;
    }
}
