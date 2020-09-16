<?php

declare(strict_types=1);

use function HappyHelpers\xml\formatLevel;

namespace HappyHelpers\Tests\Unit\xml;

use HappyHelpers\Tests\Helper\xml\LibXmlErrorProvidingTrait;
use function HappyHelpers\xml\formatError;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\xml\formatError()
 *
 * @uses ::HappyHelpers\xml\formatLevel()
 */
class formatErrorTest extends TestCase
{
    use LibXmlErrorProvidingTrait;

    /**
     * @test
     * @dataProvider provideErrors
     */
    public function it_knows_how_to_format_errors(\LibXMLError $error, string $expected): void
    {
        self::assertSame($expected, formatError($error));
    }

    public function provideErrors()
    {
        yield 'error' => [
            $this->createError(LIBXML_ERR_ERROR),
            '[ERROR] file.xml: message (0) on line 99,0',
        ];
        yield 'warning' => [
            $this->createError(LIBXML_ERR_WARNING),
            '[WARNING] file.xml: message (0) on line 99,0',
        ];
        yield 'none' => [
            $this->createError(LIBXML_ERR_NONE),
            '[NONE] file.xml: message (0) on line 99,0',
        ];
        yield 'fatal' => [
            $this->createError(LIBXML_ERR_FATAL),
            '[FATAL] file.xml: message (0) on line 99,0',
        ];
        yield 'unkown' => [
            $this->createError(900000),
            '[NONE] file.xml: message (0) on line 99,0',
        ];
        yield 'with_code_and_column' => [
            $this->createError(LIBXML_ERR_FATAL, function (\LibXMLError $error): void {
                $error->code = 10;
                $error->column = 20;
            }),
            '[FATAL] file.xml: message (10) on line 99,20',
        ];
    }
}
