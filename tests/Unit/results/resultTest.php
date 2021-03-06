<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\results;

use function HappyHelpers\results\result;
use HappyHelpers\results\Types\Failure;
use HappyHelpers\results\Types\Ok;
use HappyHelpers\results\Types\Result;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\results\result()
 *
 * @uses \HappyHelpers\results\Types\Ok
 * @uses \HappyHelpers\results\Types\Failure
 */
class resultTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideOkResults
     *
     * @param mixed $value
     */
    public function it_can_build_ok_results($value): void
    {
        $result = result($value);

        self::assertInstanceOf(Result::class, $result);
        self::assertInstanceOf(Ok::class, $result);
        self::assertTrue($result->isOk());
        self::assertFalse($result->isFailure());
        self::assertSame($value, $result->value());
    }

    /**
     * @test
     */
    public function it_can_build_failure_results(): void
    {
        $exception = new \RuntimeException('NOT GOOD');
        $result = result($exception);

        self::assertInstanceOf(Result::class, $result);
        self::assertInstanceOf(Failure::class, $result);
        self::assertFalse($result->isOk());
        self::assertTrue($result->isFailure());
        self::assertSame($exception, $result->value());
    }

    public function provideOkResults()
    {
        yield 'string' => ['Hello'];
        yield 'int' => [1];
        yield 'float' => [1.1];
        yield 'bool' => [true];
        yield 'null' => [null];
        yield 'array' => [[]];
        yield 'object' => [(object) []];
        yield 'callable' => [fn () => ''];
    }
}
