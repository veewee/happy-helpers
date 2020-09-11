<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\dom\loader;

use function HappyHelpers\dom\loader\xmlFileLoader;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\dom\loader\xmlFileLoader()
 */
class xmlFileLoaderTest extends TestCase
{
    /** @test */
    public function it_can_load_xml_file(): void
    {
        $doc = new \DOMDocument();
        $xml = '<hello />';
        [$file, $handle] = $this->fillFile($xml);
        $loader = xmlFileLoader($file);

        self::assertIsCallable($loader);

        $result = $loader($doc);
        self::assertTrue($result);
        self::assertXmlStringEqualsXmlString($xml, $doc->saveXML());

        fclose($handle);
    }

    /** @test */
    public function it_cannot_load_invalid_xml_file(): void
    {
        $doc = new \DOMDocument();
        $xml = '<hello';
        [$file, $handle] = $this->fillFile($xml);
        $loader = xmlFileLoader($file);

        self::assertIsCallable($loader);

        $result = @$loader($doc);
        self::assertFalse($result);

        fclose($handle);
    }

    /** @test */
    public function it_throws_exception_on_invalid_file(): void
    {
        $doc = new \DOMDocument();

        $this->expectException(\InvalidArgumentException::class);
        xmlFileLoader('invalidFile')($doc);
    }

    private function fillFile(string $content): array
    {
        $handle = tmpfile();
        $path = stream_get_meta_data($handle)['uri'];
        fwrite($handle, $content);

        return [$path, $handle];
    }
}
