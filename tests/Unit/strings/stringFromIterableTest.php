<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\strings;

use function HappyHelpers\strings\stringFromIterable;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\strings\stringFromIterable()
 *
 * @uses ::HappyHelpers\iterables\toList()
 */
class stringFromIterableTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideIterables
     */
    public function it_can_convert_iterables_to_a_string(
        iterable $items,
        string $glue,
        string $expected
    ): void {
        $result = stringFromIterable($items, $glue);
        self::assertSame($expected, $result);
    }

    public function provideIterables()
    {
        yield 'convertArray' => [
            ['a', 'b', 'c'],
            ',',
            'a,b,c',
        ];

        yield 'appendIterable' => [
            new \ArrayIterator(['a', 'b', 'c']),
            ',',
            'a,b,c',
        ];
    }
}
