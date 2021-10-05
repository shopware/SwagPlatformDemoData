<?php declare(strict_types=1);

namespace Swag\PlatformDemoData;

use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\ActivateContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;

class SwagPlatformDemoData extends Plugin
{
    private DemoDataService $demoDataService;

    public function activate(ActivateContext $activateContext): void
    {
        $this->demoDataService->generate($activateContext->getContext());
    }

    public function uninstall(UninstallContext $uninstallContext): void
    {
        if ($uninstallContext->keepUserData()) {
            return;
        }

        $this->demoDataService->delete($uninstallContext->getContext());
    }

    /**
     * @required
     */
    public function setDemoDataService(DemoDataService $demoDataService): void
    {
        $this->demoDataService = $demoDataService;
    }
}
