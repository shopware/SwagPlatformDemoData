<?php

declare(strict_types=1);

/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Shopware\Core\TestBootstrapper;

if (!class_exists(TestBootstrapper::class)) {
    require_once __DIR__ . '/../../../../src/Core/TestBootstrapper.php';
}
$bootstrapper = new TestBootstrapper();

$bootstrapper->getClassLoader()->addPsr4('Swag\\PlatformDemoDataTests\\', __DIR__);

$bootstrapper
    ->setPlatformEmbedded(false)
    ->addCallingPlugin()
    ->bootstrap();
