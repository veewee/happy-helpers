<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\xml;

use function HappyHelpers\xml\detectXmlErrors;
use HappyHelpers\xml\Exception\XmlErrorsException;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\xml\detectXmlErrors()
 *
 * @uses ::HappyHelpers\xml\useInternalErrors()
 * @uses ::HappyHelpers\assertions\assertExtensionLoaded()
 * @uses ::HappyHelpers\iterables\map
 * @uses ::HappyHelpers\iterables\toList
 * @uses ::HappyHelpers\strings\stringFromIterable
 * @uses ::HappyHelpers\xml\formatError
 * @uses ::HappyHelpers\xml\formatLevel
 * @uses \HappyHelpers\xml\Exception\XmlErrorsException
 */
class detectXmlErrorsTest extends TestCase
{
    /** @test */
    public function it_can_continue_when_no_errors_are_detects(): void
    {
        $result = detectXmlErrors(
            static function () {
                self::assertTrue(libxml_use_internal_errors());

                return 'ok';
            }
        );

        self::assertSame('ok', $result);
    }

    /** @test */
    public function it_can_detect_xml_errors_inside_callable(): void
    {
        try {
            detectXmlErrors(
                static function () {
                    \simplexml_load_string('<notvalidxml');

                    return 'ok';
                }
            );
        } catch (XmlErrorsException $exception) {
            self::assertCount(1, $exception->errors());
        }
    }

    /** @test */
    public function it_does_not_use_previously_occured_exceptions(): void
    {
        \libxml_use_internal_errors(true);
        \simplexml_load_string('<notvalidxml');

        try {
            detectXmlErrors(
                static function () {
                    \simplexml_load_string('<notvalidxml');

                    return 'ok';
                }
            );
        } catch (XmlErrorsException $exception) {
            self::assertCount(1, $exception->errors());
        }
    }
}
