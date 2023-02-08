<?php

declare(strict_types=1);

namespace PhelPhpStorm\PhpStormSyntax;

use Gacela\Framework\AbstractConfig;
use Gacela\Framework\AbstractFactory;
use Phel\Api\ApiFacadeInterface;
use PhelPhpStorm\PhpStormSyntax\Domain\PhelFunctionRepositoryInterface;
use PhelPhpStorm\PhpStormSyntax\Domain\ReadmeFileGenerator;
use PhelPhpStorm\PhpStormSyntax\Infrastructure\PhelFunctionRepository;
use PhelPhpStorm\PhpStormSyntax\Infrastructure\ReadmeFile;

/**
 * @method Config getConfig()
 */
final class Factory extends AbstractFactory
{
    public function createReadmeFile(): ReadmeFile
    {
        return new ReadmeFile(
            $this->createReadmeFileGenerator(),
            $this->getConfig()->getAppRootDir(),
        );
    }

    private function createReadmeFileGenerator(): ReadmeFileGenerator
    {
        return new ReadmeFileGenerator(
            $this->createPhelFunctionRepository()
        );
    }

    private function createPhelFunctionRepository(): PhelFunctionRepositoryInterface
    {
        return new PhelFunctionRepository(
            $this->getPhelFnNormalizerFacade(),
            $this->getConfig()->allNamespaces()
        );
    }

    private function getPhelFnNormalizerFacade(): ApiFacadeInterface
    {
        return $this->getProvidedDependency(DependencyProvider::FACADE_API_PHEL);
    }
}
