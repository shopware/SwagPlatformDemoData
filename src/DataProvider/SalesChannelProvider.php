<?php declare(strict_types=1);

namespace Swag\PlatformDemoData\DataProvider;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;

class SalesChannelProvider extends DemoDataProvider
{
    /**
     * @var Connection
     */
    private $connection;

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
        return 'sales_channel';
    }

    public function getPayload(): array
    {
        $payload = [];
        foreach ($this->getSalesChannelIds() as $salesChannelId) {
            $payload[] = [
                'id' => $salesChannelId,
                'navigationCategoryId' => 'f9aa6920eb7d44c7a516a38ed68fcc35'
            ];
        }

        return $payload;
    }

    private function getSalesChannelIds(): array
    {
        return $this->connection->executeQuery('
            SELECT LOWER(HEX(`id`))
            FROM `sales_channel`;
        ')->fetchAll(FetchMode::COLUMN);
    }
}
