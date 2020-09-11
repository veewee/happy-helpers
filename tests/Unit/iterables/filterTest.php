<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\iterables;

use function HappyHelpers\iterables\filter;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\iterables\filter()
 */
class filterTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideFilters
     */
    public function it_can_lazily_filter_an_iterable(
        iterable $items,
        callable $filter,
        array $expected
    ): void {
        $result = filter($items, $filter);

        self::assertInstanceOf(\Generator::class, $result);
        self::assertSame($expected, iterator_to_array($result));
    }

    public function provideFilters()
    {
        yield 'plainArray' => [
            [1, 2, 3, 4],
            fn (int $value): bool => $value > 2,
            [2 => 3, 3 => 4],
        ];
        yield 'iterableArray' => [
            new \ArrayIterator([1, 2, 3, 4]),
            fn (int $value): bool => $value > 2,
            [2 => 3, 3 => 4],
        ];
        yield 'filterbyKey' => [
            new \ArrayIterator(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
            fn (int $value, string $key): bool => $key > 'b',
            ['c' => 3, 'd' => 4],
        ];
    }
}
