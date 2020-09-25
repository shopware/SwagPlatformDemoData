<?php declare(strict_types=1);

namespace Swag\PlatformDemoDataTests;

use Doctrine\DBAL\Connection;
use PHPUnit\Framework\TestCase;
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

        $connection->executeUpdate('DELETE FROM product');
        $connection->executeUpdate('DELETE FROM category WHERE parent_id IS NOT NULL');
        $connection->executeUpdate('DELETE FROM customer');
        $connection->executeUpdate('DELETE FROM property_group_option');
        $connection->executeUpdate('DELETE FROM property_group');
    }

    public function testGenerate(): void
    {
        $demoDataService = $this->getContainer()->get(DemoDataService::class);
        $context = Context::createDefaultContext();
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

    public function testGenerateFailsOnInvalidData(): void
    {
        $provider = $this->createMock(DemoDataProvider::class);
        $provider->method('getAction')->willReturn('upsert');
        $provider->method('getEntity')->willReturn('product');
        $provider->method('getPayload')->willReturn([
            [
                'id' => Uuid::randomHex(),
                'invalid' => true
            ]
        ]);

        $demoDataService = new DemoDataService(
            $this->getContainer()->get(SyncController::class),
            [$provider],
            $this->getContainer()->get('request_stack'),
            'prod'
        );

        $this->expectException(\Throwable::class);
        $demoDataService->generate(Context::createDefaultContext());
    }

    private function assertEntityCountGreaterThanOrEqual(int $expectedCount, string $repositoryName)
    {
        /** @var EntityRepositoryInterface $repository */
        $repository = $this->getContainer()->get($repositoryName);
        $ids = $repository->searchIds(new Criteria(), Context::createDefaultContext())->getIds();
        static::assertGreaterThanOrEqual($expectedCount, count($ids), 'There should be ' . $expectedCount . ' or more entities in ' . $repositoryName);
    }
}
