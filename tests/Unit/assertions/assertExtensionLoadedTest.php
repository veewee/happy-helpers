<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\assertions;

use function HappyHelpers\assertions\assertExtensionLoaded;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\assertions\assertExtensionLoaded()
 */
class assertExtensionLoadedTest extends TestCase
{
    /**
     * @test
     * @doesNotPerformAssertions
     */
    public function it_guards_if_an_extension_is_loaded(): void
    {
        assertExtensionLoaded('Core');
    }

    /** @test */
    public function it_guards_if_an_extension_is_not_loaded(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The extension-does-not-exist extension is not loaded!');

        assertExtensionLoaded('extension-does-not-exist');
    }
}
