<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\results\_Internal;

use HappyHelpers\functional\Types\Functor;
use HappyHelpers\results\_Internal\Failure;
use HappyHelpers\results\Types\Result;
use PHPUnit\Framework\TestCase;

/**
 * @covers \HappyHelpers\results\_Internal\Failure
 */
class FailureTest extends TestCase
{
    /** @test */
    public function it_is_a_negative_result(): void
    {
        $result = new Failure($exception = new \Exception('NOPE'));

        self::assertInstanceOf(Result::class, $result);
        self::assertInstanceOf(Failure::class, $result);
        self::assertFalse($result->isOk());
        self::assertTrue($result->isFailure());
        self::assertSame($exception, $result->value());
    }

    /** @test */
    public function it_does_not_map_negative_values(): void
    {
        $result = new Failure($exception = new \Exception('NOPE'));
        $transformed = $result->map(fn ($value) => 'newvalue');

        self::assertSame($result, $transformed);
        self::assertInstanceOf(Functor::class, $result);
        self::assertSame($exception, $transformed->value());
    }

    /** @test */
    public function it_can_proceed_from_negative_result(): void
    {
        $result = new Failure($exception = new \Exception('NOPE'));
        $proceeded = $result->proceed(
            fn ($value) => $value.' yes',
            fn (\Throwable $exception) => $exception->getMessage()
        );

        self::assertSame($exception->getMessage(), $proceeded);
    }
}
