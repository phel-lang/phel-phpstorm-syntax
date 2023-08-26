<?php

declare(strict_types=1);

use Phel\Config\PhelConfig;

return (new PhelConfig())
    ->setSrcDirs([])
    ->setTestDirs([])
    ->setVendorDir('/vendor');
