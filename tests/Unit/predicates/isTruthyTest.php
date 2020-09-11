<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\predicates;

use function HappyHelpers\predicates\isTruthy;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\predicates\isTruthy()
 */
class isTruthyTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideValues
     *
     * @param mixed $value
     */
    public function it_knows_if_a_value_is_truthy($value, bool $expected): void
    {
        self::assertSame($expected, isTruthy($value));
    }

    public function provideValues()
    {
        yield 'string' => ['Hello', true];
        yield 'emptyString' => ['', false];
        yield 'int' => [1, true];
        yield 'zero' => [0, false];
        yield 'float' => [1.1, true];
        yield 'zeroFloat' => [0.0, false];
        yield 'true' => [true, true];
        yield 'false' => [false, false];
        yield 'null' => [null, false];
        yield 'array' => [['yes'], true];
        yield 'emptyErray' => [[], false];
        yield 'object' => [(object) ['a' => 'b'], true];
        yield 'emptyObject' => [(object) [], true];
        yield 'callable' => [fn () => '', true];
    }
}
