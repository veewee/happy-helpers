<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\dom\manipulator;

use function HappyHelpers\dom\manipulator\importNode;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\dom\manipulator\importNode
 */
class importNodeTest extends TestCase
{
    /** @test */
    public function it_can_import_a_node_into_a_document_root(): void
    {
        $source = new \DOMDocument();
        $source->loadXML('<hello />');
        $target = new \DOMDocument();

        $result = importNode($source->documentElement, $target);

        self::assertTrue($result);
        self::assertXmlStringEqualsXmlString($source->saveXML(), $target->saveXML());
    }

    /** @test */
    public function it_can_not_import_a_document_into_a_document(): void
    {
        $source = new \DOMDocument();
        $source->loadXML('<hello />');
        $target = new \DOMDocument();

        $result = @importNode($source, $target);

        self::assertFalse($result);
    }

    /** @test */
    public function it_can_recursively_import_a_node_into_another_document_node(): void
    {
        $source = new \DOMDocument();
        $source->loadXML('<hello><world><name>Toon</name></world></hello>');
        $target = new \DOMDocument();
        $target->loadXML('<hello></hello>');

        $result = importNode($source->documentElement->firstChild, $target->documentElement);

        self::assertTrue($result);
        self::assertXmlStringEqualsXmlString($source->saveXML(), $target->saveXML());
    }
}
