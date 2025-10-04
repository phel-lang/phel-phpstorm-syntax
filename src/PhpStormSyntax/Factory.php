<?php

declare(strict_types=1);

namespace PhelPhpStorm\PhpStormSyntax;

use Gacela\Framework\AbstractConfig;
use Gacela\Framework\AbstractFactory;
use Phel\Api\ApiFacadeInterface;
use PhelPhpStorm\PhpStormSyntax\Domain\PhelFunctionRepositoryInterface;
use PhelPhpStorm\PhpStormSyntax\Domain\GroupedPhelFunctions;
use PhelPhpStorm\PhpStormSyntax\Infrastructure\PhelFunctionRepository;
use PhelPhpStorm\PhpStormSyntax\Infrastructure\MarkdownReadmeFileGenerator;

/**
 * @method Config getConfig()
 */
final class Factory extends AbstractFactory
{
    public function createReadmeFile(): MarkdownReadmeFileGenerator
    {
        return new MarkdownReadmeFileGenerator(
            $this->createGroupedPhelFunctions(),
            $this->getConfig()->getAppRootDir(),
        );
    }

    private function createGroupedPhelFunctions(): GroupedPhelFunctions
    {
        return new GroupedPhelFunctions(
            $this->createPhelFunctionRepository()
        );
    }

    private function createPhelFunctionRepository(): PhelFunctionRepositoryInterface
    {
        return new PhelFunctionRepository(
            $this->getPhelApiFacade(),
            $this->getConfig()->namespaces()
        );
    }

    private function getPhelApiFacade(): ApiFacadeInterface
    {
        return $this->getProvidedDependency(DependencyProvider::FACADE_API_PHEL);
    }
}
