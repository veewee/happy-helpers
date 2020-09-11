<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit;

use function HappyHelpers\identity;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\identity()
 */
class identityTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideIdentities
     *
     * @param mixed $value
     */
    public function it_knows_identity($value): void
    {
        self::assertSame($value, identity($value));
    }

    public function provideIdentities()
    {
        yield 'string' => ['Hello'];
        yield 'int' => [1];
        yield 'float' => [1.1];
        yield 'bool' => [true];
        yield 'null' => [null];
        yield 'array' => [[]];
        yield 'object' => [(object) []];
        yield 'callable' => [fn () => ''];
    }
}
