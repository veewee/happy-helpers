<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\dom\loader;

use DOMDocument;
use function HappyHelpers\dom\loader\xmlNodeLoader;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\dom\loader\xmlNodeLoader()
 *
 * @uses ::HappyHelpers\dom\manipulator\importNode()
 */
class xmlNodeLoaderTest extends TestCase
{
    /** @test */
    public function it_can_load_xml_node(): void
    {
        $source = new DOMDocument();
        $source->loadXML($xml = '<hello />');

        $doc = new DOMDocument();
        $loader = xmlNodeLoader($source->documentElement);

        self::assertIsCallable($loader);

        $result = $loader($doc);
        self::assertTrue($result);
        self::assertXmlStringEqualsXmlString($xml, $doc->saveXML());
    }

    /** @test */
    public function it_can_not_load_invalid_xml_node(): void
    {
        $source = new DOMDocument();
        $source->loadXML($xml = '<hello />');

        $doc = new DOMDocument();
        $loader = xmlNodeLoader($source);

        self::assertIsCallable($loader);

        $result = @$loader($doc);
        self::assertFalse($result);
    }
}
