<?php

declare(strict_types=1);

namespace PhelPhpStorm\PhpStormSyntax\Domain;

use Phel\Api\Transfer\PhelFunction;

interface PhelFunctionRepositoryInterface
{
    /**
     * @return list<PhelFunction>
     */
    public function getPhelFunctions(): array;
}
