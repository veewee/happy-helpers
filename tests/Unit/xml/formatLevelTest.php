<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\xml;

use function HappyHelpers\xml\formatLevel;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\xml\formatLevel()
 */
class formatLevelTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideErrors
     */
    public function it_knows_how_to_format_error_levels(\LibXMLError $error, string $expected): void
    {
        self::assertSame($expected, formatLevel($error));
    }

    public function provideErrors()
    {
        yield 'error' => [
            $this->createError(LIBXML_ERR_ERROR),
            'error',
        ];
        yield 'warning' => [
            $this->createError(LIBXML_ERR_WARNING),
            'warning',
        ];
        yield 'none' => [
            $this->createError(LIBXML_ERR_NONE),
            'none',
        ];
        yield 'fatal' => [
            $this->createError(LIBXML_ERR_FATAL),
            'fatal',
        ];
        yield 'unkown' => [
            $this->createError(900000),
            'none',
        ];
    }

    private function createError(int $level): \LibXMLError
    {
        $error = new \LibXMLError();
        $error->level = $level;

        return $error;
    }
}
