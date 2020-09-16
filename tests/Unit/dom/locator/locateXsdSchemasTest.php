<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\dom\locator;

use DOMDocument;
use function HappyHelpers\dom\locator\locateNamespacedXsdSchemas;
use function HappyHelpers\dom\locator\locateNoNamespacedXsdSchemas;
use function HappyHelpers\dom\locator\locateXsdSchemas;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\dom\locator\locateNamespacedXsdSchemas
 * @covers ::HappyHelpers\dom\locator\locateNoNamespacedXsdSchemas
 * @covers ::HappyHelpers\dom\locator\locateXsdSchemas
 */
class locateXsdSchemasTest extends TestCase
{
    /** @test */
    public function it_can_locate_namespaced_xsd_schemas(): void
    {
        $document = $this->loadXsdContainer();
        $results = locateNamespacedXsdSchemas($document);

        self::assertInstanceOf(\Generator::class, $results);
        self::assertSame(
            [
                'note-namespace1.xsd',
                'http://localhost/note-namespace2.xsd',
            ],
            [...$results]
        );
    }

    /** @test */
    public function it_can_locate_no_namespaced_xsd_schemas(): void
    {
        $document = $this->loadXsdContainer();
        $results = locateNoNamespacedXsdSchemas($document);

        self::assertInstanceOf(\Generator::class, $results);
        self::assertSame(
            [
                'note-nonamespace1.xsd',
                'http://localhost/note-nonamespace2.xsd',
            ],
            [...$results]
        );
    }

    /** @test */
    public function it_can_locate_all_xsd_schemas(): void
    {
        $document = $this->loadXsdContainer();
        $results = locateXsdSchemas($document);

        self::assertInstanceOf(\Generator::class, $results);
        self::assertSame(
            [
                'note-namespace1.xsd',
                'http://localhost/note-namespace2.xsd',
                'note-nonamespace1.xsd',
                'http://localhost/note-nonamespace2.xsd',
            ],
            [...$results]
        );
    }

    private function loadXsdContainer(): DOMDocument
    {
        $file = FIXTURE_DIR.'/dom/locator/xsd/xsdcontainer.xml';
        self::assertFileExists($file);

        $document = new DOMDocument();
        $document->load($file);

        return $document;
    }
}
