<?php

declare(strict_types=1);

namespace HappyHelpers\dom\configurator;

use DOMDocument;

function utf8(DOMDocument $document): DOMDocument
{
    $document->encoding = 'UTF-8';

    return $document;
}
