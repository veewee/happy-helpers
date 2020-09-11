<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\dom\configurator;

use function HappyHelpers\dom\configurator\withTrimmedContents;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\dom\configurator\trimContents()
 * @covers ::HappyHelpers\dom\configurator\withTrimmedContents()
 */
class trimContentsTest extends TestCase
{
    /** @test */
    public function it_can_trim_contents(): void
    {
        $doc = new \DOMDocument();
        $doc->loadXML($xml = '<hello />');

        $callable = withTrimmedContents();
        self::assertIsCallable($callable);

        $result = $callable($doc);
        self::assertSame($doc, $result);
        self::assertFalse($doc->preserveWhiteSpace);
        self::assertFalse($doc->formatOutput);
        self::assertXmlStringEqualsXmlString($xml, $doc->saveXML());
    }
}
