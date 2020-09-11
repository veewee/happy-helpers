<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\dom;

use function HappyHelpers\dom\documentFromXmlString;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\dom\documentFromXmlString()
 *
 * @uses ::HappyHelpers\dom\document()
 * @uses ::HappyHelpers\assertions\assertExtensionLoaded()
 * @uses ::HappyHelpers\callables\after
 * @uses ::HappyHelpers\dom\configurator\withLoader
 * @uses ::HappyHelpers\dom\loader\xmlStringLoader
 * @uses ::HappyHelpers\xml\detectXmlErrors
 * @uses ::HappyHelpers\xml\useInternalErrors
 */
class documentFromXmlStringTest extends TestCase
{
    /** @test */
    public function it_can_create_a_document_from_xml_string(): void
    {
        $doc = documentFromXmlString(
            $xml = '<hello />',
            fn (\DOMDocument $document): \DOMDocument => $document
        );

        self::assertInstanceOf(\DOMDocument::class, $doc);
        self::assertXmlStringEqualsXmlString($xml, $doc->saveXML());
    }
}
