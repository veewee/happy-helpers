<?php

declare(strict_types=1);

namespace HappyHelpers\assertions;

use function in_array;
use Webmozart\Assert\Assert;

function assertExtensionLoaded(string $extension): void
{
    Assert::true(
        in_array($extension, get_loaded_extensions(), true),
        'The '.$extension.' extension is not loaded!'
    );
}
