<?php

declare(strict_types=1);

namespace PhelPhpStorm\PhpStormSyntax;

use Gacela\Framework\AbstractDependencyProvider;
use Gacela\Framework\Container\Container;
use Phel\Api\ApiFacade;

/**
 * @method Factory getFactory()
 */
final class DependencyProvider extends AbstractDependencyProvider
{
    public const FACADE_API_PHEL = 'FACADE_API_PHEL';

    public function provideModuleDependencies(Container $container): void
    {
        $container->set(self::FACADE_API_PHEL, function (Container $container) {
            return $container->getLocator()->get(ApiFacade::class);
        });
    }
}
