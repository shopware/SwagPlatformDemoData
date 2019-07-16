<?php declare(strict_types=1);

namespace Swag\PlatformDemoData\DataProvider;

class CategoryProvider extends DemoDataProvider
{
    public function getPriority(): int
    {
        return 900;
    }

    public function getAction(): string
    {
        return 'upsert';
    }

    public function getEntity(): string
    {
        return 'category';
    }

    public function getPayload(): array
    {
        return [
            [
                'id' => 'f9aa6920eb7d44c7a516a38ed68fcc35',
                'cmsPageId'=> '695477e02ef643e5a016b83ed4cdf63a',
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'name' => [
                    'de-DE' => 'Katalog #1',
                    'en-GB' => 'Catalogue #1'
                ],
                'children' => [
                    [
                        'id' => '77b959cf66de4c1590c7f9b7da3982f3',
                        'cmsPageId'=> 'cd0f8e5823044d798001b371c2687a24',
                        'active' => false,
                        'displayNestedProducts' => true,
                        'visible' => true,
                        'type' => 'page',
                        'name' => [
                            'de-DE' => 'Lebensmittel',
                            'en-GB' => 'Food'
                        ],
                        'children' => [
                            [
                                'id' => '19ca405790ff4f07aac8c599d4317868',
                                'cmsPageId'=> 'cd0f8e5823044d798001b371c2687a24',
                                'active' => true,
                                'displayNestedProducts' => true,
                                'visible' => true,
                                'type' => 'page',
                                'name' => [
                                    'de-DE' => 'Backwaren',
                                    'en-GB' => 'Bakery products'
                                ],
                            ],
                            [
                                'id' => '48f97f432fd041388b2630184139cf0e',
                                'cmsPageId'=> 'cd0f8e5823044d798001b371c2687a24',
                                'active' => true,
                                'displayNestedProducts' => true,
                                'visible' => true,
                                'type' => 'page',
                                'afterCategoryId' => '19ca405790ff4f07aac8c599d4317868',
                                'name' => [
                                    'de-DE' => 'Fisch',
                                    'en-GB' => 'Fish'
                                ],
                            ],
                            [
                                'id' => 'bb22b05bff9140f3808b1cff975b75eb',
                                'cmsPageId'=> 'cd0f8e5823044d798001b371c2687a24',
                                'active' => true,
                                'displayNestedProducts' => true,
                                'visible' => true,
                                'type' => 'page',
                                'afterCategoryId' => '48f97f432fd041388b2630184139cf0e',
                                'name' => [
                                    'de-DE' => 'Süßes',
                                    'en-GB' => 'Sweets'
                                ],
                            ]
                        ]
                    ],
                    [
                        'id' => 'a515ae260223466f8e37471d279e6406',
                        'cmsPageId'=> 'cd0f8e5823044d798001b371c2687a24',
                        'active' => true,
                        'displayNestedProducts' => true,
                        'visible' => true,
                        'type' => 'page',
                        'afterCategoryId' => '77b959cf66de4c1590c7f9b7da3982f3',
                        'name' => [
                            'de-DE' => 'Bekleidung',
                            'en-GB' => 'Clothing'
                        ],
                        'children' => [
                            [
                                'id' => '8de9b484c54f441c894774e5f57e485c',
                                'cmsPageId'=> 'cd0f8e5823044d798001b371c2687a24',
                                'active' => true,
                                'displayNestedProducts' => true,
                                'visible' => true,
                                'type' => 'page',
                                'name' => [
                                    'de-DE' => 'Damen',
                                    'en-GB' => 'Women'
                                ],
                            ],
                            [
                                'id' => '2185182cbbd4462ea844abeb2a438b33',
                                'cmsPageId'=> 'cd0f8e5823044d798001b371c2687a24',
                                'active' => true,
                                'displayNestedProducts' => true,
                                'visible' => true,
                                'type' => 'page',
                                'afterCategoryId' => '8de9b484c54f441c894774e5f57e485c',
                                'name' => [
                                    'de-DE' => 'Herren',
                                    'en-GB' => 'Men'
                                ],
                            ]
                        ]
                    ],
                    [
                        'id' => '251448b91bc742de85643f5fccd89051',
                        'cmsPageId'=> 'cd0f8e5823044d798001b371c2687a24',
                        'active' => true,
                        'displayNestedProducts' => true,
                        'visible' => true,
                        'type' => 'page',
                        'afterCategoryId' => 'a515ae260223466f8e37471d279e6406',
                        'name' => [
                            'de-DE' => 'Freizeit & Elektro',
                            'en-GB' => 'Free time & electronics'
                        ],
                    ]
                ]
            ]
        ];
    }
}