<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\xml\_Internal;

use HappyHelpers\xml\Exception\XmlErrorsException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \HappyHelpers\xml\Exception\XmlErrorsException
 *
 * @uses ::HappyHelpers\iterables\map
 * @uses ::HappyHelpers\iterables\toList
 * @uses ::HappyHelpers\strings\stringFromIterable
 * @uses ::HappyHelpers\xml\formatError
 * @uses ::HappyHelpers\xml\formatLevel
 */
class XmlErrorsExceptionTest extends TestCase
{
    /** @test */
    public function it_can_throw_an_exception_containing_xml_errors(): void
    {
        $errors = [
            $this->createError(LIBXML_ERR_FATAL),
            $this->createError(LIBXML_ERR_WARNING),
        ];
        $exception = XmlErrorsException::fromXmlErrors($errors);

        self::assertSame($errors, $exception->errors());

        $this->expectException(XmlErrorsException::class);
        $this->expectExceptionMessage(implode(PHP_EOL, [
            '[FATAL] file.xml: message (0) on line 99,0',
            '[WARNING] file.xml: message (0) on line 99,0',
        ]));

        throw $exception;
    }

    /** @test */
    public function it_can_only_accept_a_list_of_xml_exceptions(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        XmlErrorsException::fromXmlErrors(['hi', 'hi']);
    }

    private function createError(int $level): \LibXMLError
    {
        $error = new \LibXMLError();
        $error->level = $level;
        $error->file = 'file.xml';
        $error->message = 'message';
        $error->line = 99;
        $error->code = 0;
        $error->column = 0;

        return $error;
    }
}
