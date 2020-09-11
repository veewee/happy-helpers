<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\generator;

use function HappyHelpers\generators\repeat;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\generators\repeat()
 */
class repeatTest extends TestCase
{
    /** @test */
    public function it_can_lazily_generate_values(): void
    {
        $x = repeat(3, fn () => 'Hello');

        self::assertInstanceOf(\Generator::class, $x);
        self::assertSame(
            ['Hello', 'Hello', 'Hello'],
            [...$x]
        );
    }
}
