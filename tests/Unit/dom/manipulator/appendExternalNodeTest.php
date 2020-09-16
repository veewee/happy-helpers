<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\dom\manipulator;

use DOMElement;
use function HappyHelpers\dom\manipulator\appendExternalNode;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\dom\manipulator\appendExternalNode
 *
 * @uses ::HappyHelpers\dom\manipulator\importNodeDeeply
 */
class appendExternalNodeTest extends TestCase
{
    /** @test */
    public function it_can_import_a_node_into_a_document_root(): void
    {
        $source = new \DOMDocument();
        $source->loadXML('<hello />');
        $target = new \DOMDocument();

        $result = appendExternalNode($source->documentElement, $target);

        self::assertInstanceOf(DOMElement::class, $result);
        self::assertSame('hello', $result->nodeName);
        self::assertXmlStringEqualsXmlString($source->saveXML(), $target->saveXML());
    }

    /** @test */
    public function it_can_not_import_a_document_into_a_document(): void
    {
        $source = new \DOMDocument();
        $source->loadXML('<hello />');
        $target = new \DOMDocument();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot import node: Node Type Not Supported');
        appendExternalNode($source, $target);
    }

    /** @test */
    public function it_can_recursively_import_a_node_into_another_document_node(): void
    {
        $source = new \DOMDocument();
        $source->loadXML('<hello><world><name>VeeWee</name></world></hello>');
        $target = new \DOMDocument();
        $target->loadXML('<hello></hello>');

        $result = appendExternalNode($source->documentElement->firstChild, $target->documentElement);

        self::assertInstanceOf(DOMElement::class, $result);
        self::assertSame('world', $result->nodeName);
        self::assertXmlStringEqualsXmlString($source->saveXML(), $target->saveXML());
    }
}
