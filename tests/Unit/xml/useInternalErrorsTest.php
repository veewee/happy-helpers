<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\xml;

use function HappyHelpers\xml\useInternalErrors;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\xml\useInternalErrors()
 *
 * @uses ::HappyHelpers\assertions\assertExtensionLoaded()
 */
class useInternalErrorsTest extends TestCase
{
    /** @test */
    public function it_can_use_internal_xml_errors_during_a_function_call(): void
    {
        libxml_use_internal_errors(false);

        $result = useInternalErrors(
            static function () {
                self::assertTrue(libxml_use_internal_errors());

                return 'ok';
            }
        );

        self::assertFalse(libxml_use_internal_errors());
        self::assertSame('ok', $result);
    }
}
