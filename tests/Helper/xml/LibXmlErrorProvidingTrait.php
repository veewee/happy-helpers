<?php

declare(strict_types=1);

namespace HappyHelpers\Tests\Helper\xml;

use LibXMLError;

trait LibXmlErrorProvidingTrait
{
    private function createError(int $level, ?callable $configurator = null): LibXMLError
    {
        $error = new LibXMLError();
        $error->level = $level;
        $error->file = 'file.xml';
        $error->message = 'message';
        $error->line = 99;
        $error->code = null;
        $error->column = null;

        if (null !== $configurator) {
            $configurator($error);
        }

        return $error;
    }
}
