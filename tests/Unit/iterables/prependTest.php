<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\iterables;

use function HappyHelpers\iterables\prepend;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\iterables\prepend()
 */
class prependTest extends TestCase
{
    /**
     * @test
     * @dataProvider providePrepends
     */
    public function it_can_lazily_prepend_iterables_of_same_types(
        iterable $source,
        array $prepend,
        array $expected
    ): void {
        $result = prepend($source, ...$prepend);

        self::assertInstanceOf(\Generator::class, $result);
        self::assertSame($expected, [...$result]);
    }

    public function providePrepends()
    {
        yield 'prependArray' => [
            ['a'],
            ['b', 'c'],
            ['b', 'c', 'a'],
        ];

        yield 'prependIterable' => [
            new \ArrayIterator(['a']),
            ['b', 'c'],
            ['b', 'c', 'a'],
        ];
    }
}
