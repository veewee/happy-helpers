<?php

declare(strict_types=1);

namespace HappyHelpers\dom\configurator;

use DOMDocument;

function trimContents(DOMDocument $document): DOMDocument
{
    $document->preserveWhiteSpace = false;
    $document->formatOutput = false;

    return $document;
}
