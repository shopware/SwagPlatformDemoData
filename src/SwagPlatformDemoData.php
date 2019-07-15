<?php declare(strict_types=1);

namespace Swag\PlatformDemoData;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Api\Controller\SyncController;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\InstallContext;

class SwagPlatformDemoData extends Plugin
{
    public function install(InstallContext $context): void
    {
        $this->importDemoData($context->getContext());
        $this->clearCache();
    }

    private function importDemoData(Context $context): void
    {
        $demoDataService = new DemoDataService(
            $this->container->get(Connection::class),
            $this->container->get(SyncController::class)
        );

        $demoDataService->generate($this->container, $context);
    }

    private function clearCache(): void
    {
        $cache = $this->container->get('shopware.cache');
        $cache->clear();
    }
}
