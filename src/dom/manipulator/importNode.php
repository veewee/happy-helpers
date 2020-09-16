<?php

declare(strict_types=1);

namespace HappyHelpers\dom\manipulator;

use DOMDocument;
use DOMNode;
use Webmozart\Assert\Assert;

function importNode(DOMNode $source, DOMNode $target): bool
{
    $document = $target instanceof DOMDocument ? $target : $target->ownerDocument;
    Assert::notNull($document);

    $copy = $document->importNode($source, true);
    if (!$copy) {
        return false;
    }

    $target->appendChild($copy);

    return true;
}
