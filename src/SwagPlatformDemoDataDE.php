<?php declare(strict_types=1);

namespace Swag\PlatformDemoDataDE;

use Doctrine\DBAL\Connection;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\InstallContext;

class SwagPlatformDemoDataDE extends Plugin
{
    public function install(InstallContext $context): void
    {
        $this->importMedia();
        $this->installDemoData();

        $this->clearCache();
    }

    private function importMedia(): void
    {
        $projectDir = $this->container->getParameter('kernel.project_dir');
        $pluginMediaDir = __DIR__ . '/Resources/media';
        $mediaDir = $projectDir . '/public/media';

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($pluginMediaDir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            if ($item->isDir()) {
                $concurrentDirectory = $mediaDir . DIRECTORY_SEPARATOR . $iterator->getSubPathName();

                if (!$this->createDirectory($concurrentDirectory)) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
                }
            } else {
                copy($item->getRealPath(), $mediaDir . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            }
        }
    }

    private function installDemoData(): void
    {
        /** @var $connection Connection */
        $connection = $this->container->get('Doctrine\DBAL\Connection');

        $dataPaths = $this->getDataFilesList();

        $connection->executeUpdate('SET FOREIGN_KEY_CHECKS = 0;');
        try {
            foreach ($dataPaths as $dataFile) {
                $sql = file_get_contents($dataFile);
                $connection->executeUpdate($sql);
            }
        } catch (\Exception $exception) {}

        $connection->executeUpdate('SET FOREIGN_KEY_CHECKS = 1;');

        if (isset($exception)) {
            throw $exception;
        }
    }

    private function getDataFilesList(): array
    {
        $regexPattern = '/^([0-9]*)-.+\.sql/i';

        $dataPath = __DIR__ . '/Resources/data/';

        $directoryIterator = new \DirectoryIterator($dataPath);
        $regex = new \RegexIterator($directoryIterator, $regexPattern, \RecursiveRegexIterator::GET_MATCH);

        $dataPaths = [];

        foreach ($regex as $result) {
            $dataPriority = intval($result['1']);
            $dataPaths[$dataPriority] = $dataPath . $result['0'];
        }

        ksort($dataPaths);

        return $dataPaths;
    }

    private function createDirectory(string $concurrentDirectory): bool
    {
        return !(!is_dir($concurrentDirectory) && mkdir($concurrentDirectory) && !is_dir($concurrentDirectory));
    }

    private function clearCache(): void
    {
        $cache = $this->container->get('shopware.cache');
        $cache->clear();
    }
}
