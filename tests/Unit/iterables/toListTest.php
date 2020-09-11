<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\iterables;

use function HappyHelpers\iterables\toList;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\iterables\toList()
 */
class toListTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideLists
     */
    public function it_converts_iterator_to_a_list(
        iterable $items,
        array $expected
    ): void {
        $result = toList($items);

        self::assertSame($expected, $result);
    }

    public function provideLists()
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
            [1, 2, 3, 4],
        ];
        yield 'keyedIterator' => [
            new \ArrayIterator(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
            [1, 2, 3, 4],
        ];
    }
}
