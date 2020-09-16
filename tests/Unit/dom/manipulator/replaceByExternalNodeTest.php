<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\dom\manipulator;

use DOMElement;
use function HappyHelpers\dom\manipulator\replaceByExternalNode;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\dom\manipulator\replaceByExternalNode
 *
 * @uses ::HappyHelpers\dom\manipulator\importNodeDeeply
 */
class replaceByExternalNodeTest extends TestCase
{
    /** @test */
    public function it_can_replace_a_node(): void
    {
        $source = new \DOMDocument();
        $source->loadXML('<hello />');
        $target = new \DOMDocument();
        $target->loadXML('<world />');

        $result = replaceByExternalNode($source->documentElement, $target->documentElement);

        self::assertInstanceOf(DOMElement::class, $result);
        self::assertSame('hello', $result->nodeName);
        self::assertXmlStringEqualsXmlString($source->saveXML(), $target->saveXML());
    }

    /** @test */
    public function it_can_not_replace_a_document_into_a_document(): void
    {
        $source = new \DOMDocument();
        $source->loadXML('<hello />');
        $target = new \DOMDocument();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Could not replace a node without parent node. (DOMDocument)');
        replaceByExternalNode($source, $target);
    }

    /** @test */
    public function it_can_recursively_replace_a_node_with_another_external_node(): void
    {
        $source = new \DOMDocument();
        $source->loadXML('<hello><world><name>VeeWee</name></world></hello>');
        $target = new \DOMDocument();
        $target->loadXML('<hello></hello>');
        $expected = new \DOMDocument();
        $expected->loadXML('<world><name>VeeWee</name></world>');

        $result = replaceByExternalNode($source->documentElement->firstChild, $target->documentElement);

        self::assertInstanceOf(DOMElement::class, $result);
        self::assertSame('world', $result->nodeName);
        self::assertXmlStringEqualsXmlString($expected->saveXML(), $target->saveXML());
    }
}
