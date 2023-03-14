<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PlatformDemoData\DataProvider;

use Doctrine\DBAL\Connection;
use Shopware\Core\Content\Property\PropertyGroupDefinition;
use Swag\PlatformDemoData\Resources\helper\TranslationHelper;

class PropertyProvider extends DemoDataProvider
{
    private TranslationHelper $translationHelper;

    public function __construct(Connection $connection)
    {
        $this->translationHelper = new TranslationHelper($connection);
    }

    public function getAction(): string
    {
        return 'upsert';
    }

    public function getEntity(): string
    {
        return 'property_group';
    }

    public function getPayload(): array
    {
        return [
            [
                'id' => '1857bb30fe6448c88f8ad331cf6dfa0c',
                'sortingType' => PropertyGroupDefinition::SORTING_TYPE_ALPHANUMERIC,
                'displayType' => PropertyGroupDefinition::DISPLAY_TYPE_TEXT,
                'name' => $this->translationHelper->adjustTranslations([
                    'de-DE' => 'Zielgruppe',
                    'en-GB' => 'Target group',
                ]),
                'options' => [
                    [
                        'id' => '78c53f3f6dd14eb4927978415bfb74db',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Mann',
                            'en-GB' => 'Man',
                        ]),
                    ],
                    [
                        'id' => '7cab88165ae5420f921232511b6e8f7d',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Frau',
                            'en-GB' => 'Woman',
                        ]),
                    ],
                    [
                        'id' => '6f9359239c994b48b7de282ee19a714d',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Kinder',
                            'en-GB' => 'Children',
                        ]),
                    ],
                ],
            ],
            [
                'id' => '269c7e40a54a462e884edb004c5f7bc8',
                'sortingType' => PropertyGroupDefinition::SORTING_TYPE_ALPHANUMERIC,
                'displayType' => PropertyGroupDefinition::DISPLAY_TYPE_COLOR,
                'name' => $this->translationHelper->adjustTranslations([
                    'de-DE' => 'Farbe',
                    'en-GB' => 'Colour',
                ]),
                'options' => [
                    [
                        'id' => '2bfd278e87204807a890da4a3e81dd90',
                        'colorHexCode' => '#0000ffff',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Blau',
                            'en-GB' => 'Blue',
                        ]),
                    ],
                    [
                        'id' => '52454db2adf942b2ac079a296f454a10',
                        'colorHexCode' => '#ff0000ff',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Rot',
                            'en-GB' => 'Red',
                        ]),
                    ],
                    [
                        'id' => 'ad735af1ebfb421e93e408b073c4a89a',
                        'colorHexCode' => '#ffffffff',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Weiß',
                            'en-GB' => 'White',
                        ]),
                    ],
                ],
            ],
            [
                'id' => '448f3d72803f4ac8afc0c1108739ddf4',
                'sortingType' => PropertyGroupDefinition::SORTING_TYPE_ALPHANUMERIC,
                'displayType' => PropertyGroupDefinition::DISPLAY_TYPE_TEXT,
                'name' => $this->translationHelper->adjustTranslations([
                    'de-DE' => 'Zutaten',
                    'en-GB' => 'Ingredients',
                ]),
                'options' => [
                    [
                        'id' => '22bdaee755804c1d8099c0d3696e852c',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Zucker',
                            'en-GB' => 'Sugar',
                        ]),
                    ],
                    [
                        'id' => '327d6c0b12264d7bb479ee18eb66ab23',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Fisch',
                            'en-GB' => 'Fish',
                        ]),
                    ],
                    [
                        'id' => '34066fc5b043464caaaca5b1ec5aa233',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Weizen',
                            'en-GB' => 'Wheat',
                        ]),
                    ],
                    [
                        'id' => '673c97246aad4704b0be14ce21b93b06',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Salz',
                            'en-GB' => 'Salt',
                        ]),
                    ],
                    [
                        'id' => '77421c4f75af40c8a57657cdc2ad49a2',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Milch',
                            'en-GB' => 'Milk',
                        ]),
                    ],
                    [
                        'id' => 'd5d798a26c7640b3a5f837a02b93a08b',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Pfeffer',
                            'en-GB' => 'Pepper',
                        ]),
                    ],
                ],
            ],
            [
                'id' => '75f353b589d04bf48e8a9ab1f5422b0e',
                'sortingType' => PropertyGroupDefinition::SORTING_TYPE_ALPHANUMERIC,
                'displayType' => PropertyGroupDefinition::DISPLAY_TYPE_TEXT,
                'name' => $this->translationHelper->adjustTranslations([
                    'de-DE' => 'Größe',
                    'en-GB' => 'Size',
                ]),
                'options' => [
                    [
                        'id' => '41e5013b67d64d3a92b7a275da8af441',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'S',
                            'en-GB' => 'S',
                        ]),
                    ],
                    [
                        'id' => '5997d91dc0784997bdef68dfc5a08912',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'M',
                            'en-GB' => 'M',
                        ]),
                    ],
                    [
                        'id' => '54147692cbfb43419a6d11e26cad44dc',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'L',
                            'en-GB' => 'L',
                        ]),
                    ],
                    [
                        'id' => 'acfd7586d02848f1ac801f4776efa414',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'XL',
                            'en-GB' => 'XL',
                        ]),
                    ],
                ],
            ],
            [
                'id' => 'a67cdd9627cb488bb4cd91f3e8d66e32',
                'sortingType' => PropertyGroupDefinition::SORTING_TYPE_ALPHANUMERIC,
                'displayType' => PropertyGroupDefinition::DISPLAY_TYPE_TEXT,
                'name' => $this->translationHelper->adjustTranslations([
                    'de-DE' => 'Material',
                    'en-GB' => 'Material',
                ]),
                'options' => [
                    [
                        'id' => '5193ffa5de8648a1bcfba1fa8a26c02b',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Polyester',
                            'en-GB' => 'Polyester',
                        ]),
                    ],
                    [
                        'id' => '96638a1c7ab847bbb3ca64167ab30a3e',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Baumwolle',
                            'en-GB' => 'Cotton',
                        ]),
                    ],
                    [
                        'id' => 'acda76f103774960a7f8f96ff5563f8d',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Seide',
                            'en-GB' => 'Silk',
                        ]),
                    ],
                    [
                        'id' => 'c36d68be7cc043c98c78375891eac40a',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Edelstahl',
                            'en-GB' => 'Stainless steel',
                        ]),
                    ],
                    [
                        'id' => 'c53fa30db00e4a84b4516f6b07c02e8d',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Leder',
                            'en-GB' => 'Leather',
                        ]),
                    ],
                    [
                        'id' => 'dc6f98beeca44852beb078a9e8e21e7d',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Kunstoff',
                            'en-GB' => 'Plastic',
                        ]),
                    ],
                    [
                        'id' => 'dfabbd52199e4d7abd8ff01bafcbd372',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Nylon',
                            'en-GB' => 'Nylon',
                        ]),
                    ],
                ],
            ],
        ];
    }
}
