<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\dom;

use function HappyHelpers\dom\documentFromXmlFile;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\dom\documentFromXmlFile()
 *
 * @uses ::HappyHelpers\dom\document()
 * @uses ::HappyHelpers\assertions\assertExtensionLoaded()
 * @uses ::HappyHelpers\callables\after
 * @uses ::HappyHelpers\dom\configurator\withLoader
 * @uses ::HappyHelpers\dom\loader\xmlFileLoader
 * @uses ::HappyHelpers\xml\detectXmlErrors
 * @uses ::HappyHelpers\xml\useInternalErrors
 */
class documentFromXmlFileTest extends TestCase
{
    /** @test */
    public function it_can_create_a_document_from_xml_string(): void
    {
        [$file, $handle] = $this->fillFile($xml = '<hello />');

        $doc = documentFromXmlFile(
            $file,
            fn (\DOMDocument $document): \DOMDocument => $document
        );

        self::assertInstanceOf(\DOMDocument::class, $doc);
        self::assertXmlStringEqualsXmlString($xml, $doc->saveXML());

        fclose($handle);
    }

    private function fillFile(string $content): array
    {
        $handle = tmpfile();
        $path = stream_get_meta_data($handle)['uri'];
        fwrite($handle, $content);

        return [$path, $handle];
    }
}
