<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PlatformDemoData\DataProvider;

use Doctrine\DBAL\Connection;

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
        $ruleId = $this->getRuleId();
        $payload = [];
        foreach ($this->getShippingMethodIds() as $shippingMethodId) {
            $payload[] = [
                'id' => $shippingMethodId,
                'availabilityRuleId' => $ruleId,
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

    private function getRuleId(): string
    {
        $result = $this->connection->fetchOne('
            SELECT LOWER(HEX(`id`))
            FROM `rule`
        ');

        if (!$result) {
            throw new \RuntimeException('No rule found, please make sure that basic data is available by running the migrations.');
        }

        return (string) $result;
    }
}
