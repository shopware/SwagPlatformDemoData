<?php declare(strict_types=1);

namespace Swag\PlatformDemoData\DataProvider;

use Shopware\Core\Content\Cms\DataResolver\FieldConfig;
use Swag\PlatformDemoData\Resources\helper\TranslationHelper;

class CmsPageProvider extends DemoDataProvider
{
    /**
     * @var TranslationHelper
     */
    private $translationHelper;

    public function __construct(\Doctrine\DBAL\Connection $connection)
    {
        $this->translationHelper = new TranslationHelper($connection);
    }

    public function getAction(): string
    {
        return 'upsert';
    }

    public function getEntity(): string
    {
        return 'cms_page';
    }

    public function getPayload(): array
    {
        return [
            [
                'id' => '695477e02ef643e5a016b83ed4cdf63a',
                'type' => 'landingpage',
                'locked' => 0,
                'name' => $this->translationHelper->adjustTranslations([
                    'de-DE' => 'Startseite',
                    'en-GB' => 'Homepage',
                ]),
                'sections' => [
                    [
                        'id' => '935477e02ef643e5a016b83ed4cdf63a',
                        'position' => 1,
                        'type' => 'default',
                        'blocks' => [
                            [
                                'position' => 0,
                                'type' => 'image-cover',
                                'locked' => 0,
                                'sizingMode' => 'boxed',
                                'backgroundMediaMode' => 'cover',
                                'slots' => [
                                    [
                                        'type' => 'image',
                                        'slot' => 'image',
                                        'locked' => 0,
                                        'translations' => $this->translationHelper->adjustTranslations([
                                            'de-DE' => [
                                                'config' => [
                                                    'url' => [
                                                        'value' => null,
                                                        'source' => FieldConfig::SOURCE_STATIC,
                                                    ],
                                                    'media' => [
                                                        'value' => 'de4b7dbe9d95435092cb85ce146ced28',
                                                        'source' => FieldConfig::SOURCE_STATIC,
                                                    ],
                                                    'newTab' => [
                                                        'value' => false,
                                                        'source' => FieldConfig::SOURCE_STATIC,
                                                    ],
                                                    'minHeight' => [
                                                        'value' => '340px',
                                                        'source' => FieldConfig::SOURCE_STATIC,
                                                    ],
                                                    'displayMode' => [
                                                        'value' => 'standard',
                                                        'source' => FieldConfig::SOURCE_STATIC,
                                                    ],
                                                ],
                                            ],
                                            'en-GB' => [
                                                'config' => [
                                                    'url' => [
                                                        'value' => null,
                                                        'source' => FieldConfig::SOURCE_STATIC,
                                                    ],
                                                    'media' => [
                                                        'value' => 'de4b7dbe9d95435092cb85ce146ced28',
                                                        'source' => FieldConfig::SOURCE_STATIC,
                                                    ],
                                                    'newTab' => [
                                                        'value' => false,
                                                        'source' => FieldConfig::SOURCE_STATIC,
                                                    ],
                                                    'minHeight' => [
                                                        'value' => '340px',
                                                        'source' => FieldConfig::SOURCE_STATIC,
                                                    ],
                                                    'displayMode' => [
                                                        'value' => 'standard',
                                                        'source' => FieldConfig::SOURCE_STATIC,
                                                    ],
                                                ],
                                            ],
                                        ]),
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
