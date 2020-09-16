<?php

declare(strict_types=1);

namespace HappyHelpers\dom\manipulator;

use DOMNode;

function appendExternalNode(DOMNode $source, DOMNode $target): DOMNode
{
    $copy = importNodeDeeply($source, $target);
    $target->appendChild($copy);

    return $copy;
}
