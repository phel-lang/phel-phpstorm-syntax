<?php

declare(strict_types=1);

namespace PhelPhpStorm\PhpStormSyntax\Infrastructure;

use Phel\Api\ApiFacadeInterface;
use Phel\Api\Transfer\PhelFunction;
use PhelPhpStorm\PhpStormSyntax\Domain\PhelFunctionRepositoryInterface;

final class PhelFunctionRepository implements PhelFunctionRepositoryInterface
{
    public function __construct(
        private ApiFacadeInterface $apiFacade,
        private array $allNamespaces = []
    ) {
    }

    /**
     * @return PhelFunction
     */
    public function getAllPhelFunctions(): array
    {
        return $this->apiFacade->getPhelFunctions($this->allNamespaces);
    }
}
