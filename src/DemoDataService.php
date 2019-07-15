<?php declare(strict_types=1);

namespace Swag\PlatformDemoData;

use Composer\Autoload\ClassMapGenerator;
use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Api\Controller\SyncController;
use Shopware\Core\Framework\Context;
use Swag\PlatformDemoData\DataProvider\DemoDataProvider;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class DemoDataService
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var SyncController
     */
    private $sync;

    public function __construct(
        Connection $connection,
        SyncController $sync
    )
    {
        $this->connection = $connection;
        $this->sync = $sync;
    }

    public function generate(ContainerInterface $container, Context $context): void
    {
        $this->truncateTables();
        $this->importDemoData($container, $context);
    }

    private function truncateTables(): void
    {
        $this->connection->beginTransaction();
        $this->connection->executeUpdate('SET FOREIGN_KEY_CHECKS = 0;');

        $this->connection->executeUpdate(file_get_contents(__DIR__ . '/Resources/sql/truncates.sql'));

        $this->connection->executeUpdate('SET FOREIGN_KEY_CHECKS = 1;');
        $this->connection->commit();
    }

    private function importDemoData(ContainerInterface $container, Context $context): void
    {
        $dataProviders = $this->loadDataProvider();

        /** @var DemoDataProvider $dataProvider */
        foreach ($dataProviders as $dataProvider) {
            $payload = [
                [
                    'action' => $dataProvider->getAction(),
                    'entity' => $dataProvider->getEntity(),
                    'payload' => $dataProvider->getPayload()
                ]
            ];

            $response  = $this->sync->sync(new Request([], [], [], [], [], [], json_encode($payload)), $context);
            $result = json_decode($response->getContent(), true);

            if (count($result['errors']) > 0) {
                throw new \RuntimeException(sprintf('Error importing "%s": %s', $dataProvider->getEntity(), print_r($result['errors'], true)));
            }

            $dataProvider->finalize($container, $context);
        }

    }

    private function loadDataProvider(): array
    {
        $classes = ClassMapGenerator::createMap(__DIR__ . '/DataProvider');

        $dataProviders = [];
        foreach ($classes as $fqcn => $file) {
            if (is_subclass_of($fqcn, DemoDataProvider::class)) {
                /** @var DemoDataProvider $provider */
                $provider = new $fqcn($this->connection);

                $dataProviders[$provider->getPriority()] = $provider;
            }
        }
        krsort($dataProviders);

        return $dataProviders;
    }
}