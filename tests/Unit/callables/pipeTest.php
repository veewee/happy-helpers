<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\callables;

use function HappyHelpers\callables\pipe;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\callables\pipe()
 *
 * @uses ::HappyHelpers\iterables\foldLeft()
 */
class pipeTest extends TestCase
{
    /** @test */
    public function it_combines_multiple_function_to_executes_in_order(): void
    {
        $x = pipe(
            fn (string $x): string => $x.' world',
            fn (string $y): string => $y.'?',
            fn (string $z): string => $z.'!',
        );

        self::assertSame('Hello world?!', $x('Hello'));
    }

    /** @test */
    public function it_combines_multiple_function_and_does_not_care_about_types(): void
    {
        $x = pipe(
            fn (string $x): int => \mb_strlen($x),
            fn (int $y): string => $y.'!'
        );

        self::assertSame('5!', $x('Hello'));
    }

    /** @test */
    public function it_can_create_an_empty_combination(): void
    {
        $x = pipe();

        self::assertSame('Hello', $x('Hello'));
    }
}
