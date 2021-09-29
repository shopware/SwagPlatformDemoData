<?php declare(strict_types=1);

namespace Swag\PlatformDemoDataTests;

use Doctrine\DBAL\Connection;
use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Api\Context\SystemSource;
use Shopware\Core\Framework\Api\Controller\SyncController;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;
use Shopware\Core\Framework\Uuid\Uuid;
use Swag\PlatformDemoData\DataProvider\DemoDataProvider;
use Swag\PlatformDemoData\DemoDataService;

class DemoDataServiceTest extends TestCase
{
    use IntegrationTestBehaviour;

    public function setUp(): void
    {
        $connection = $this->getContainer()->get(Connection::class);

        $connection->executeStatement('DELETE FROM product');
        $connection->executeStatement('DELETE FROM category WHERE parent_id IS NOT NULL');
        $connection->executeStatement('DELETE FROM customer');
        $connection->executeStatement('DELETE FROM property_group_option');
        $connection->executeStatement('DELETE FROM property_group');
    }

    public function testGenerate(): void
    {
        static::assertTrue($this->getContainer()->has(DemoDataService::class));
        $demoDataService = $this->getContainer()->get(DemoDataService::class);

        static::assertInstanceOf(DemoDataService::class, $demoDataService);
        $context = new Context(new SystemSource());
        $demoDataService->generate($context);
        static::assertTrue(true);

        $this->assertEntityCountGreaterThanOrEqual(9, 'category.repository');
        $this->assertEntityCountGreaterThanOrEqual(1, 'customer.repository');
        $this->assertEntityCountGreaterThanOrEqual(1, 'cms_page.repository');
        $this->assertEntityCountGreaterThanOrEqual(9, 'media.repository');
        $this->assertEntityCountGreaterThanOrEqual(5, 'property_group.repository');
        $this->assertEntityCountGreaterThanOrEqual(23, 'property_group_option.repository');
        $this->assertEntityCountGreaterThanOrEqual(5, 'rule.repository');
        $this->assertEntityCountGreaterThanOrEqual(1, 'sales_channel.repository');
        $this->assertEntityCountGreaterThanOrEqual(1, 'shipping_method.repository');
        $this->assertEntityCountGreaterThanOrEqual(16, 'product.repository');
    }

    private function assertEntityCountGreaterThanOrEqual(int $expectedCount, string $repositoryName): void
    {
        /** @var EntityRepositoryInterface $repository */
        $repository = $this->getContainer()->get($repositoryName);
        $ids = $repository->searchIds(new Criteria(), new Context(new SystemSource()))->getIds();
        static::assertGreaterThanOrEqual($expectedCount, \count($ids), 'There should be ' . $expectedCount . ' or more entities in ' . $repositoryName);
    }
}
