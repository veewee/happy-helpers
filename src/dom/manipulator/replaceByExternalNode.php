<?php

declare(strict_types=1);

namespace HappyHelpers\dom\manipulator;

use DOMNode;
use function get_class;
use Webmozart\Assert\Assert;

function replaceByExternalNode(DOMNode $source, DOMNode $target): DOMNode
{
    Assert::notNull($target->parentNode, 'Could not replace a node without parent node. ('.get_class($target).')');

    $copy = importNodeDeeply($source, $target);
    $oldNode = $target->parentNode->replaceChild($copy, $target);
    Assert::notFalse($oldNode, 'Could not replace the child node.');

    return $copy;
}
