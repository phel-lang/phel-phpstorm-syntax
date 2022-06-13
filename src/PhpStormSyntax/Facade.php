<?php

declare(strict_types=1);

namespace PhelPhpStorm\PhpStormSyntax;

use Gacela\Framework\AbstractFacade;

/**
 * @method Factory getFactory()
 */
final class Facade extends AbstractFacade
{
    public function updateReadme(): void
    {
        $this->getFactory()
            ->createReadmeFile()
            ->generate();
    }
}
