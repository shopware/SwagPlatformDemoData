<?php

declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PlatformDemoData;

use Shopware\Core\Framework\Log\Package;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\ActivateContext;
use Shopware\Core\Framework\Plugin\Context\DeactivateContext;

#[Package('services-settings')]
class SwagPlatformDemoData extends Plugin
{
    public function activate(ActivateContext $activateContext): void
    {
        // @phpstan-ignore-next-line
        $this->container->get(DemoDataService::class)->generate($activateContext->getContext());
    }

    public function deactivate(DeactivateContext $deactivateContext): void
    {
        // @phpstan-ignore-next-line
        $this->container->get(DemoDataService::class)->delete($deactivateContext->getContext());
    }
}
