<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\predicates;

use function HappyHelpers\predicates\when;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\predicates\when()
 *
 * @uses ::HappyHelpers\predicates\isTruthy()
 */
class whenTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideValues
     *
     * @param mixed $value
     * @param mixed $expected
     */
    public function it_knows_when_to_call_which_function(
        $value,
        callable $collector,
        callable $fallback,
        $expected
    ): void {
        self::assertSame($expected, when($value, $collector, $fallback));
    }

    public function provideValues()
    {
        yield 'fallback' => [
            '',
            fn () => 'nope',
            fn () => 'yepperz',
            'yepperz',
        ];
        yield 'value' => [
            'myvalue',
            fn (string $value) => $value,
            fn () => 'nope',
            'myvalue',
        ];
        yield 'transformed' => [
            'myvalue',
            fn (string $value) => 'yepperz',
            fn () => 'nope',
            'yepperz',
        ];
    }
}
