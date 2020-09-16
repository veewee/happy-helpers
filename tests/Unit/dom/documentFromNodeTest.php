<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\dom;

use DOMDocument;
use function HappyHelpers\dom\documentFromNode;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\dom\documentFromNode()
 *
 * @uses ::HappyHelpers\assertions\assertExtensionLoaded
 * @uses ::HappyHelpers\callables\after
 * @uses ::HappyHelpers\dom\configurator\withLoader
 * @uses ::HappyHelpers\dom\document
 * @uses ::HappyHelpers\dom\loader\xmlNodeLoader
 * @uses ::HappyHelpers\dom\manipulator\appendExternalNode
 * @uses ::HappyHelpers\dom\manipulator\importNodeDeeply
 * @uses ::HappyHelpers\xml\detectXmlErrors
 * @uses ::HappyHelpers\xml\useInternalErrors
 */
class documentFromNodeTest extends TestCase
{
    /** @test */
    public function it_can_create_a_document_from_xml_string(): void
    {
        $source = new DOMDocument();
        $source->loadXML($xml = '<hello />');

        $doc = documentFromNode(
            $source->documentElement,
            fn (DOMDocument $document): DOMDocument => $document
        );

        self::assertInstanceOf(DOMDocument::class, $doc);
        self::assertXmlStringEqualsXmlString($xml, $doc->saveXML());
    }
}
