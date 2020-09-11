<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\iterables;

use function HappyHelpers\iterables\toMap;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\iterables\toMap()
 */
class toMapTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideMaps
     */
    public function it_converts_iterator_to_a_list(
        iterable $items,
        array $expected
    ): void {
        $result = toMap($items);

        self::assertSame($expected, $result);
    }

    public function provideMaps()
    {
        yield 'plainArray' => [
            [1, 2, 3, 4],
            [1, 2, 3, 4],
        ];
        yield 'iterableArray' => [
            new \ArrayIterator([1, 2, 3, 4]),
            [1, 2, 3, 4],
        ];
        yield 'keyedArray' => [
            ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
            ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
        ];
        yield 'keyedIterator' => [
            new \ArrayIterator(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
            ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
        ];
    }
}
