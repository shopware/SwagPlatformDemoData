<?php

declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PlatformDemoData\DataProvider;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Log\Package;

#[Package('services-settings')]
class RuleProvider extends DemoDataProvider
{
    private Connection $connection;

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
        return 'rule';
    }

    public function getPayload(): array
    {
        $usaId = $this->getCountryIdByIsoCode('US');

        return [
            [
                'id' => '28caae75a5624f0d985abd0eb32aa160',
                'name' => 'Alle Kunden der Standard-Kundengruppe',
                'priority' => 1,
                'conditions' => [
                    [
                        'type' => 'orContainer',
                        'children' => [
                            [
                                'type' => 'andContainer',
                                'children' => [
                                    [
                                        'type' => 'customerCustomerGroup',
                                        'value' => [
                                            'operator' => '=',
                                            'customerGroupIds' => ['cfbd5018d38d41d8adca10d94fc8bdd6'],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'id' => '3858957016644de4ae48c0500bf3ccc8',
                'name' => 'Warenkorbwert größer/gleich 0 (Zahlungsarten)',
                'priority' => 100,
                'conditions' => [
                    [
                        'type' => 'orContainer',
                        'children' => [
                            [
                                'type' => 'andContainer',
                                'children' => [
                                    [
                                        'type' => 'cartCartAmount',
                                        'value' => [
                                            'operator' => '>=',
                                            'amount' => 0,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'id' => '3cf541369e6d4a2fa70aa8687a65fc2d',
                'name' => 'Ist Sonntag',
                'priority' => 2,
                'conditions' => [
                    [
                        'type' => 'orContainer',
                        'children' => [
                            [
                                'type' => 'andContainer',
                                'children' => [
                                    [
                                        'type' => 'dayOfWeek',
                                        'value' => [
                                            'operator' => '=',
                                            'dayOfWeek' => 7,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'id' => 'a62e1f6a1a0b4519af401b6270a37149',
                'name' => 'Kunden aus den USA',
                'priority' => 100,
                'conditions' => [
                    [
                        'type' => 'orContainer',
                        'children' => [
                            [
                                'type' => 'andContainer',
                                'children' => [
                                    [
                                        'type' => 'customerBillingCountry',
                                        'value' => [
                                            'operator' => '=',
                                            'countryIds' => [$usaId],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'id' => 'e1378db7808a478f919e0d740d5d6c1a',
                'name' => 'Warenkorbwert größer/gleich 0',
                'priority' => 100,
                'conditions' => [
                    [
                        'type' => 'orContainer',
                        'children' => [
                            [
                                'type' => 'andContainer',
                                'children' => [
                                    [
                                        'type' => 'cartCartAmount',
                                        'value' => [
                                            'operator' => '>=',
                                            'amount' => 0,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    private function getCountryIdByIsoCode(string $iso): string
    {
        $result = $this->connection->fetchOne('
            SELECT LOWER(HEX(`id`))
            FROM `country`
            WHERE `iso` = :iso;
        ', ['iso' => $iso]);

        if (!$result) {
            throw new \RuntimeException('No country for iso code "' . $iso . '" found, please make sure that basic data is available by running the migrations.');
        }

        return (string) $result;
    }
}
