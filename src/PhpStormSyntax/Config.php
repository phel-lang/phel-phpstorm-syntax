<?php

declare(strict_types=1);

namespace PhelPhpStorm\PhpStormSyntax;

use Gacela\Framework\AbstractConfig;

final class Config extends AbstractConfig
{
    /**
     * @return list<string>
     */
    public function allNamespaces(): array
    {
        return [
            'phel\\core',
            'phel\\http',
            'phel\\html',
            'phel\\test',
            'phel\\json',
        ];
    }
}
