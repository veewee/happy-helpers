<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\iterables;

use function HappyHelpers\iterables\foldLeft;
use function HappyHelpers\iterables\reduce;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\iterables\foldLeft()
 * @covers ::HappyHelpers\iterables\reduce()
 */
class foldLeftTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideFolds
     *
     * @param mixed $start
     * @param mixed $expected
     */
    public function it_can_perform_a_left_fold_on_a_list(
        iterable $items,
        callable $reducer,
        $start,
        $expected
    ): void {
        self::assertSame(
            $expected,
            foldLeft($items, $reducer, $start)
        );
        self::assertSame(
            $expected,
            reduce($items, $reducer, $start)
        );
    }

    public function provideFolds()
    {
        yield 'addValues' => [
            [1, 2, 3],
            fn (int $result, int $value): int => $result + $value,
            0,
            6,
        ];
        yield 'addValuesWithStart' => [
            [1, 2, 3],
            fn (int $result, int $value): int => $result + $value,
            4,
            10,
        ];
        yield 'countKeys' => [
            [1, 2, 3],
            fn (int $result, int $value, int $keys): int => $result + 1,
            0,
            3,
        ];
        yield 'addStrings' => [
            ['hello', 'world', '!'],
            fn (string $result, string $value): string => $result.$value,
            '',
            'helloworld!',
        ];
        yield 'addStringsFromiterable' => [
            new \ArrayIterator(['hello', 'world', '!']),
            fn (string $result, string $value): string => $result.$value,
            '',
            'helloworld!',
        ];
    }
}
