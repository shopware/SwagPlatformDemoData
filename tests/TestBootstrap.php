<?php declare(strict_types=1);

use Shopware\Core\TestBootstrapper;

if (is_readable(__DIR__ . '/../vendor/shopware/platform/src/Core/TestBootstrapper.php')) {
    require __DIR__ . '/../vendor/shopware/platform/src/Core/TestBootstrapper.php';
} else if (is_readable(__DIR__ . '/../vendor/shopware/core/TestBootstrapper.php')) {
    require __DIR__ . '/../vendor/shopware/core/TestBootstrapper.php';
} else {
    // vendored from platform, only use local TestBootstrapper if not already defined in platform
    require __DIR__ . '/TestBootstrapper.php';
}

return (new TestBootstrapper())
    ->setLoadEnvFile(true)
    ->setForceInstallPlugins(true)
    ->addCallingPlugin()
    ->bootstrap()
    ->getClassLoader();
