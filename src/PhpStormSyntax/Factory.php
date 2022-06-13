<?php

declare(strict_types=1);

namespace PhelPhpStorm\PhpStormSyntax;

use Gacela\Framework\AbstractFactory;
use PhelNormalizedInternal\PhelNormalizedInternalFacadeInterface;
use PhelPhpStorm\PhpStormSyntax\Domain\ReadmeFileGenerator;
use PhelPhpStorm\PhpStormSyntax\Infrastructure\ReadmeFile;

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
            $this->getPhelFnNormalizerFacade()
        );
    }

    private function getPhelFnNormalizerFacade(): PhelNormalizedInternalFacadeInterface
    {
        return $this->getProvidedDependency(DependencyProvider::FACADE_PHEL_NORMALIZED_INTERNAL);
    }
}
