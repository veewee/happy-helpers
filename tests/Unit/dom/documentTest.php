<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\dom;

use function HappyHelpers\callables\pipe;
use function HappyHelpers\dom\configurator\withLoader;
use function HappyHelpers\dom\configurator\withTrimmedContents;
use function HappyHelpers\dom\configurator\withUtf8;
use function HappyHelpers\dom\document;
use function HappyHelpers\dom\loader\xmlStringLoader;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\dom\document()
 *
 * @uses ::HappyHelpers\assertions\assertExtensionLoaded()
 */
class documentTest extends TestCase
{
    /** @test */
    public function it_can_create_a_document(): void
    {
        $doc = document(fn (\DOMDocument $document): \DOMDocument => $document);

        self::assertInstanceOf(\DOMDocument::class, $doc);
    }

    /**
     * @test
     *
     * @uses ::HappyHelpers\callables\pipe
     * @uses ::HappyHelpers\dom\configurator\trimContents
     * @uses ::HappyHelpers\dom\configurator\utf8
     * @uses ::HappyHelpers\dom\configurator\withLoader
     * @uses ::HappyHelpers\dom\configurator\withTrimmedContents
     * @uses ::HappyHelpers\dom\configurator\withUtf8
     * @uses ::HappyHelpers\dom\loader\xmlStringLoader
     * @uses ::HappyHelpers\iterables\foldLeft
     * @uses ::HappyHelpers\xml\detectXmlErrors
     * @uses ::HappyHelpers\xml\useInternalErrors
     */
    public function it_can_add_various_configurators(): void
    {
        $doc = document(pipe(
            withLoader(xmlStringLoader($xml = '<hello />')),
            withTrimmedContents(),
            withUtf8()
        ));

        self::assertInstanceOf(\DOMDocument::class, $doc);
        self::assertFalse($doc->preserveWhiteSpace);
        self::assertFalse($doc->formatOutput);
        self::assertSame('UTF-8', $doc->encoding);
        self::assertXmlStringEqualsXmlString($xml, $doc->saveXML());
    }
}
