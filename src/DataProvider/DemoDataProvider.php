<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PlatformDemoData\DataProvider;

use Shopware\Core\Framework\Context;

abstract class DemoDataProvider
{
    abstract public function getAction(): string;

    abstract public function getEntity(): string;

    /**
     * @return list<array<string, mixed>>
     */
    abstract public function getPayload(): array;

    public function finalize(Context $context): void
    {
    }
}
