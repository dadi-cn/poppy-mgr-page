<?php

declare(strict_types = 1);

namespace Poppy\Framework\Cli;

use Symfony\Component\Finder\Finder;

class Invoker
{

    public function __invoke(...$parameters): bool
    {
        $param = $parameters[1] ?? 'clear';

        if ($param !== 'clear') {
            echo 'Error Param.';
        }
        $dirname = dirname(__DIR__, 4);

        $Finder = Finder::create()
            ->name('*.php')
            ->in([
                $dirname . '/storage/framework/',
            ])
            ->depth('== 0');


        // check if there are any search results
        if ($Finder->hasResults()) {
            foreach ($Finder as $file) {
                $absoluteFilePath = $file->getRealPath();
                @unlink($absoluteFilePath);
            }
        }

        echo 'Poppy Clear succeeded.';
        return true;
    }
}
