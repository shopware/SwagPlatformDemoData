<?php

declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PlatformDemoData\DataProvider;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Log\Package;

#[Package('fundamentals@after-sales')]
class ShippingMethodProvider extends DemoDataProvider
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getAction(): string
    {
        return 'upsert';
    }

    public function getEntity(): string
    {
        return 'shipping_method';
    }

    public function getPayload(): array
    {
        $payload = [];
        foreach ($this->getShippingMethodIds() as $shippingMethodId) {
            $payload[] = [
                'id' => $shippingMethodId,
                'availabilityRuleId' => RuleProvider::CART_AMOUNT_RULE_ID,
            ];
        }

        return $payload;
    }

    /**
     * @return list<string>
     */
    private function getShippingMethodIds(): array
    {
        return $this->connection->fetchFirstColumn('
            SELECT LOWER(HEX(`id`))
            FROM `shipping_method`;
        ');
    }
}
