<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Gacela\Framework\Gacela;
use Phel\Phel;
use PhelPhpStorm\PhpStormSyntax\Facade;

Gacela::bootstrap(__DIR__, Phel::configFn());

$fileGeneratorFacade = new Facade();
$fileGeneratorFacade->updateReadme();
