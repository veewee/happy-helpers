<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\iterables;

use function HappyHelpers\iterables\append;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\iterables\append()
 */
class appendTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideAppends
     */
    public function it_can_lazily_append_iterables_of_same_types(
        iterable $source,
        array $append,
        array $expected
    ): void {
        $result = append($source, ...$append);

        self::assertInstanceOf(\Generator::class, $result);
        self::assertSame($expected, [...$result]);
    }

    public function provideAppends()
    {
        yield 'appendArray' => [
            ['a'],
            ['b', 'c'],
            ['a', 'b', 'c'],
        ];

        yield 'appendIterable' => [
            new \ArrayIterator(['a']),
            ['b', 'c'],
            ['a', 'b', 'c'],
        ];
    }
}
