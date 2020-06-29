<?php declare(strict_types=1);

namespace Swag\PlatformDemoData\DataProvider;

use Shopware\Core\Framework\Context;

abstract class DemoDataProvider
{
    abstract public function getAction(): string;

    abstract public function getEntity(): string;

    abstract public function getPayload(): array;

    public function finalize(Context $context): void
    {
    }
}
