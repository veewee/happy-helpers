<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\results\_Internal;

use HappyHelpers\functional\Types\Functor;
use HappyHelpers\results\_Internal\Ok;
use HappyHelpers\results\Types\Result;
use PHPUnit\Framework\TestCase;

/**
 * @covers \HappyHelpers\results\_Internal\Ok
 */
class OkTest extends TestCase
{
    /** @test */
    public function it_is_a_positive_result(): void
    {
        $result = new Ok($value = 'value');

        self::assertInstanceOf(Result::class, $result);
        self::assertInstanceOf(Ok::class, $result);
        self::assertTrue($result->isOk());
        self::assertFalse($result->isFailure());
        self::assertSame($value, $result->value());
    }

    /** @test */
    public function it_can_map_positive_values(): void
    {
        $value = 'ok';
        $newValue = '!';

        $result = new Ok($value);
        $transformed = $result->map(fn ($value) => $value.$newValue);

        self::assertInstanceOf(Functor::class, $result);
        self::assertInstanceOf(Functor::class, $transformed);

        self::assertNotSame($result, $transformed);
        self::assertInstanceOf(Ok::class, $transformed);
        self::assertSame('ok!', $transformed->value());
    }

    /** @test */
    public function it_can_proceed_from_positive_result(): void
    {
        $result = new Ok($value = 'ok');
        $proceeded = $result->proceed(
            fn ($value) => $value.' yes',
            fn ($value) => $value.' nope'
        );

        self::assertSame($value.' yes', $proceeded);
    }
}
