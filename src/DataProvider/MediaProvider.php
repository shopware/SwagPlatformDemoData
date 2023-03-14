<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PlatformDemoData\DataProvider;

use Doctrine\DBAL\Connection;
use Shopware\Core\Content\Media\File\FileSaver;
use Shopware\Core\Content\Media\File\MediaFile;
use Shopware\Core\Framework\Context;

class MediaProvider extends DemoDataProvider
{
    private FileSaver $fileSaver;

    private Connection $connection;

    public function __construct(Connection $connection, FileSaver $fileSaver)
    {
        $this->fileSaver = $fileSaver;
        $this->connection = $connection;
    }

    public function getAction(): string
    {
        return 'upsert';
    }

    public function getEntity(): string
    {
        return 'media';
    }

    public function getPayload(): array
    {
        $productFolder = $this->getDefaultFolderIdForEntity('product');
        $cmsFolder = $this->getDefaultFolderIdForEntity('cms_page');

        return [
            [
                'id' => '102ac62ba27347a688030a05c1790db7',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => '2de02991cd0548a4ac6cc35cb11773a0',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => '5808d194947f415495d9782d8fdc92ae',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => '6968ad64888844679918c638e449ffc5',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => '6cbbdc03b43f4207be80b5f752d5a1c4',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => '70e352200b5c45098dc65a5b47094a2a',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => '84356a71233d4b3e9f417dcc8850c82f',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => 'f69ab8ae42d04e17b2bab5ec2ff0a93c',
                'mediaFolderId' => $productFolder,
            ],
            [
                'id' => 'de4b7dbe9d95435092cb85ce146ced28',
                'mediaFolderId' => $cmsFolder,
            ],
        ];
    }

    public function finalize(Context $context): void
    {
        $files = \glob(__DIR__ . '/../Resources/media/*/*.jpg');
        if ($files === false) {
            return;
        }

        foreach ($files as $file) {
            $this->fileSaver->persistFileToMedia(
                new MediaFile(
                    $file,
                    \mime_content_type($file) ?: 'application/octet-stream',
                    \pathinfo($file, PATHINFO_EXTENSION),
                    \filesize($file) ?: 0
                ),
                \pathinfo($file, PATHINFO_FILENAME),
                \basename(\dirname($file)),
                $context
            );
        }

        parent::finalize($context);
    }

    private function getDefaultFolderIdForEntity(string $entity): string
    {
        $result = $this->connection->fetchOne('
            SELECT LOWER(HEX(`media_folder`.`id`))
            FROM `media_default_folder`
            JOIN `media_folder` ON `media_default_folder`.`id` = `media_folder`.`default_folder_id`
            WHERE `media_default_folder`.`entity` = :entity;
        ', ['entity' => $entity]);

        if (!$result) {
            throw new \RuntimeException('No default folder for entity "' . $entity . '" found, please make sure that basic data is available by running the migrations.');
        }

        return (string) $result;
    }
}
