<?php declare(strict_types=1);

namespace Swag\PlatformDemoData\DataProvider;

use Shopware\Core\Content\Cms\DataResolver\FieldConfig;

class CmsPageProvider extends DemoDataProvider
{
    public function getPriority(): int
    {
        return 1000;
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
                'name' => [
                    'de-DE' => 'Startseite',
                    'en-GB' => 'Homepage'
                ],
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
                                'translations' => [
                                    'de-De' => [
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
                                        ]
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
                                        ]
                                    ],
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'id' => 'cd0f8e5823044d798001b371c2687a24',
                'type' => 'product_list',
                'locked' => 1,
                'name' => [
                    'de-DE' => 'Standard-Kategorie-Layout',
                    'en-GB' => 'Default category layout'
                ],
                'blocks' => [
                    [
                        'position' => 0,
                        'type' => 'image-text',
                        'name' => 'Category info',
                        'locked' => 1,
                        'sizingMode' => 'boxed',
                        'marginTop' => '20px',
                        'marginBottom' => '20px',
                        'marginLeft' => '20px',
                        'marginRight' => '20px',
                        'backgroundMediaMode' => 'cover',
                        'slots' => [
                            [
                                'type' => 'image',
                                'slot' => 'left',
                                'locked' => 1,
                                'translations' => [
                                    'de-DE' => [
                                        'config' => [
                                            'url' => [
                                                'value' => null,
                                                'source' => FieldConfig::SOURCE_STATIC,
                                            ],
                                            'media' => [
                                                'value' => 'category.media',
                                                'source' => FieldConfig::SOURCE_MAPPED,
                                            ],
                                            'newTab' => [
                                                'value' => false,
                                                'source' => FieldConfig::SOURCE_STATIC,
                                            ],
                                            'minHeight' => [
                                                'value' => '320px',
                                                'source' => FieldConfig::SOURCE_STATIC,
                                            ],
                                            'displayMode' => [
                                                'value' => 'cover',
                                                'source' => FieldConfig::SOURCE_STATIC,
                                            ],
                                        ]
                                    ],
                                    'en-GB' => [
                                        'config' => [
                                            'url' => [
                                                'value' => null,
                                                'source' => FieldConfig::SOURCE_STATIC,
                                            ],
                                            'media' => [
                                                'value' => 'category.media',
                                                'source' => FieldConfig::SOURCE_MAPPED,
                                            ],
                                            'newTab' => [
                                                'value' => false,
                                                'source' => FieldConfig::SOURCE_STATIC,
                                            ],
                                            'minHeight' => [
                                                'value' => '320px',
                                                'source' => FieldConfig::SOURCE_STATIC,
                                            ],
                                            'displayMode' => [
                                                'value' => 'cover',
                                                'source' => FieldConfig::SOURCE_STATIC,
                                            ],
                                        ]
                                    ],
                                ]
                            ],
                            [
                                'type' => 'text',
                                'slot' => 'right',
                                'locked' => 1,
                                'translations' => [
                                    'de-DE' => [
                                        'config' => [
                                            'content' => [
                                                'value' => 'category.description',
                                                'source' => FieldConfig::SOURCE_MAPPED,
                                            ],
                                        ],
                                    ],
                                    'en-GB' => [
                                        'config' => [
                                            'content' => [
                                                'value' => 'category.description',
                                                'source' => FieldConfig::SOURCE_MAPPED,
                                            ],
                                        ],
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        'position' => 1,
                        'type' => 'product-listing',
                        'name' => 'Category listing',
                        'locked' => 1,
                        'sizingMode' => 'boxed',
                        'marginTop' => '20px',
                        'marginBottom' => '20px',
                        'marginLeft' => '20px',
                        'marginRight' => '20px',
                        'backgroundMediaMode' => 'cover',
                        'slots' => [
                            [
                                'type' => 'product-listing',
                                'slot' => 'content',
                                'locked' => 1,
                                'translations' => [
                                    'de-DE' => [
                                        'config' => [
                                            'boxLayout' => [
                                                'value' => 'standard',
                                                'source' => FieldConfig::SOURCE_STATIC,
                                            ],
                                        ],
                                    ],
                                    'en-GB' => [
                                        'config' => [
                                            'boxLayout' => [
                                                'value' => 'standard',
                                                'source' => FieldConfig::SOURCE_STATIC,
                                            ],
                                        ],
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}
