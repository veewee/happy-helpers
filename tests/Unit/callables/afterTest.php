<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\callables;

use function HappyHelpers\callables\after;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\callables\after()
 */
class afterTest extends TestCase
{
    /** @test */
    public function it_combines_a_function_to_executes_a_function_after_another_one(): void
    {
        $x = after(
            fn (string $x): string => $x.' world',
            fn (string $z): string => $z.'!!'
        );

        self::assertSame('Hello world!!', $x('Hello'));
    }

    /** @test */
    public function it_combines_a_function_and_does_not_care_about_types(): void
    {
        $x = after(
            fn (string $x): int => mb_strlen($x),
            fn (int $z): string => $z.'!'
        );

        self::assertSame('5!', $x('Hello'));
    }
}
