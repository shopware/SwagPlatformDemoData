<?php declare(strict_types=1);

namespace Swag\PlatformDemoData;

use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\ActivateContext;

class SwagPlatformDemoData extends Plugin
{
    /**
     * @var DemoDataService
     */
    private $demoDataService;

    public function activate(ActivateContext $context): void
    {
        $this->demoDataService->generate($context->getContext());
    }

    /**
     * @required
     */
    public function setDemoDataService(DemoDataService $demoDataService): void
    {
        $this->demoDataService = $demoDataService;
    }
}
