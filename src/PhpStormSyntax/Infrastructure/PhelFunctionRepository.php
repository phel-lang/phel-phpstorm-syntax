<?php

declare(strict_types=1);

namespace PhelPhpStorm\PhpStormSyntax\Infrastructure;

use Phel\Api\ApiFacadeInterface;
use Phel\Api\Transfer\PhelFunction;
use PhelPhpStorm\PhpStormSyntax\Domain\PhelFunctionRepositoryInterface;

final readonly class PhelFunctionRepository implements PhelFunctionRepositoryInterface
{
    public function __construct(
        private ApiFacadeInterface $apiFacade,
        private array $namespaces = []
    ) {
    }

    /**
     * @return list<PhelFunction>
     */
    public function getPhelFunctions(): array
    {
        return $this->apiFacade->getPhelFunctions($this->namespaces);
    }
}
