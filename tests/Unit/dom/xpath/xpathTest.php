<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Unit\dom\xpath;

use function HappyHelpers\dom\xpath\xpath;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::HappyHelpers\dom\xpath\xpath()
 */
class xpathTest extends TestCase
{
    /** @test */
    public function it_can_prepare_xpath(): void
    {
        $doc = new \DOMDocument();
        $doc->loadXML($xml = '<hello xmlns="http://namespace"><item /></hello>');

        $xpath = xpath($doc, ['alias' => 'http://namespace']);
        self::assertInstanceOf(\DOMXPath::class, $xpath);

        $aliasedSearch = $xpath->query('alias:item');
        self::assertCount(1, $aliasedSearch);
    }
}
