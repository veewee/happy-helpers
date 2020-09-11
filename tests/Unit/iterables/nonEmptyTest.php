<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\iterables;

use function HappyHelpers\iterables\nonEmpty;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\iterables\nonEmpty()
 *
 * @uses ::HappyHelpers\iterables\filter()
 * @uses ::HappyHelpers\predicates\isTruthy()
 */
class nonEmptyTest extends TestCase
{
    /**
     * @test
     * @dataProvider providenonEmptys
     */
    public function it_can_lazily_nonEmpty_an_iterable(
        iterable $items,
        array $expected
    ): void {
        $result = nonEmpty($items);

        self::assertInstanceOf(\Generator::class, $result);
        self::assertSame($expected, iterator_to_array($result));
    }

    public function providenonEmptys()
    {
        yield 'plainArray' => [
            [0, 1, 2, 3, 4],
            [1 => 1, 2 => 2, 3 => 3, 4 => 4],
        ];
        yield 'iterableArray' => [
            new \ArrayIterator([0, 1, 2, 3, 4]),
            [1 => 1, 2 => 2, 3 => 3, 4 => 4],
        ];
        yield 'strings' => [
            new \ArrayIterator(['hello', 'world', '']),
            ['hello', 'world'],
        ];
        yield 'bools' => [
            new \ArrayIterator([true, false]),
            [true],
        ];
        yield 'arrays' => [
            new \ArrayIterator([['yes'], []]),
            [['yes']],
        ];
    }
}
