#!/usr/bin/env php
<?php

use function HappyHelpers\callables\pipe;
use function HappyHelpers\iterables\append;
use function HappyHelpers\iterables\join;
use function HappyHelpers\iterables\map;
use function HappyHelpers\iterables\prepend;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

(static function (): void {
    $root = dirname(__DIR__);
    require $root.'/vendor/autoload.php';

    $files = Finder::create()
        ->in(dirname(__DIR__).'/src')
        ->files()
        ->notPath('_Internal')
        ->name('*.php')
        ->getIterator();

    /** @var callable(list<SplFileInfo>):string $build */
    $build = pipe(
        fn (iterable $files) => map(
            $files,
            fn (SplFileInfo $file): string => 'require_once __DIR__.\'/src/'.$file->getRelativePathname().'\';'
        ),
        fn (iterable $codeLines) => prepend($codeLines, '<?php', ''),
        fn (iterable $codeLines) => append($codeLines, ''),
        fn (iterable $codeLines) => join($codeLines, PHP_EOL)
    );

    file_put_contents($root.'/bootstrap.php', $build($files));

    echo 'Created bootstrap file!'.PHP_EOL;
})();
