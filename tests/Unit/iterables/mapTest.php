<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\iterables;

use HappyHelpers\functional\Types\Functor;
use function HappyHelpers\iterables\map;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\iterables\map()
 */
class mapTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideMaps
     */
    public function it_can_lazily_map_an_iterable(
        iterable $items,
        callable $mapper,
        array $expected
    ): void {
        $result = map($items, $mapper);

        self::assertInstanceOf(\Generator::class, $result);
        self::assertEquals($expected, iterator_to_array($result));
    }

    public function provideMaps()
    {
        yield 'plainArray' => [
            [1, 2, 3, 4],
            fn (int $value): int => $value + 1,
            [2, 3, 4, 5],
        ];
        yield 'iterableArray' => [
            new \ArrayIterator([1, 2, 3, 4]),
            fn (int $value): int => $value + 1,
            [2, 3, 4, 5],
        ];
        yield 'mapWithKey' => [
            new \ArrayIterator(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
            fn (int $value): int => $value + 1,
            ['a' => 2, 'b' => 3, 'c' => 4, 'd' => 5],
        ];
        yield 'mapWithFunctor' => [
            [
                $this->createFunctor(1),
                $this->createFunctor(2),
            ],
            fn (int $value): int => $value + 1,
            [
                $this->createFunctor(2),
                $this->createFunctor(3),
            ],
        ];
    }

    private function createFunctor(int $value)
    {
        return new class($value) implements Functor {
            private int $value;

            public function __construct(int $value)
            {
                $this->value = $value;
            }

            public function map(callable $mapper)
            {
                return new self($mapper($this->value));
            }
        };
    }
}
