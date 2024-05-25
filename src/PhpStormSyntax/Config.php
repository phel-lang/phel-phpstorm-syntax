<?php

declare(strict_types=1);

namespace PhelPhpStorm\PhpStormSyntax;

use Gacela\Framework\AbstractConfig;
use Phel\Api\ApiConfig;

final class Config extends AbstractConfig
{
    /**
     * @return list<string>
     */
    public function namespaces(): array
    {
        // all namespaces' functions except from the repl
        return array_diff((new ApiConfig())->allNamespaces(), ['phel\\repl']);
    }
}
