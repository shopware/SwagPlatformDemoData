<?php

declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PlatformDemoData\DataProvider;

use Doctrine\DBAL\Connection;
use Shopware\Core\Content\Category\CategoryCollection;
use Shopware\Core\Framework\Api\Context\SystemSource;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Log\Package;

#[Package('fundamentals@after-sales')]
class CustomerProvider extends DemoDataProvider
{
    public const CUSTOMER_ID = '6c97534c2c0747f39e8751e43cb2b013';

    private Connection $connection;

    /**
     * @var EntityRepository<CategoryCollection>
     */
    private EntityRepository $categoryRepository;

    /**
     * @param EntityRepository<CategoryCollection> $categoryRepository
     */
    public function __construct(Connection $connection, EntityRepository $categoryRepository)
    {
        $this->connection = $connection;
        $this->categoryRepository = $categoryRepository;
    }

    public function getAction(): string
    {
        return 'upsert';
    }

    public function getEntity(): string
    {
        return 'customer';
    }

    public function getPayload(): array
    {
        $salutationId = $this->getSalutationId();
        $paymentMethodId = $this->getPaymentMethodId();
        $countryId = $this->getCountryId();
        $salesChannelId = $this->getStorefrontSalesChannelId();

        return [
            [
                'id' => self::CUSTOMER_ID,
                'defaultPaymentMethodId' => $paymentMethodId,
                'salutationId' => $salutationId,
                'salesChannelId' => $salesChannelId,
                'customerNumber' => 'SWDEMO10000',
                'firstName' => 'Max',
                'lastName' => 'Mustermann',
                'password' => '$2y$10$qYoCQe2r3h/tiGIqwsq7YuuKBGCEmgtM/U4v182xtKDrFv5vSNFJO',
                'email' => 'test@example.com',
                'active' => true,
                'guest' => false,
                'newsletter' => false,
                'lastLogin' => '2019-06-12 07:13:39.641',
                'birthday' => '1996-06-06',
                'defaultShippingAddress' => [
                    'id' => 'd8f0dff7ef3947979a83c42f6509f22c',
                    'countryId' => $countryId,
                    'salutationId' => $salutationId,
                    'firstName' => 'Max',
                    'lastName' => 'Mustermann',
                    'street' => 'Musterstraße 1',
                    'zipcode' => '12345',
                    'city' => 'Musterstadt',
                ],
                'defaultBillingAddressId' => 'd8f0dff7ef3947979a83c42f6509f22c',
                'groupId' => 'cfbd5018d38d41d8adca10d94fc8bdd6',
            ],
        ];
    }

    private function getSalutationId(): string
    {
        $result = $this->connection->fetchOne('
            SELECT LOWER(HEX(COALESCE(
	            (SELECT `id` FROM `salutation` WHERE `salutation_key` = "mr" LIMIT 1),
	            (SELECT `id` FROM `salutation` LIMIT 1)
            )))
        ');

        if (!$result) {
            throw new \RuntimeException('No salutation found, please make sure that basic data is available by running the migrations.');
        }

        return (string) $result;
    }

    private function getPaymentMethodId(): string
    {
        $result = $this->connection->fetchOne('
            SELECT LOWER(HEX(`id`))
            FROM `payment_method`
            WHERE `active` = 1;
        ');

        if (!$result) {
            throw new \RuntimeException('No active payment method found, please make sure that basic data is available by running the migrations.');
        }

        return (string) $result;
    }

    private function getCountryId(): string
    {
        $result = $this->connection->fetchOne('
            SELECT LOWER(HEX(`id`))
            FROM `country`
            WHERE `active` = 1;
        ');

        if (!$result) {
            throw new \RuntimeException('No active payment method found, please make sure that basic data is available by running the migrations.');
        }

        return (string) $result;
    }

    private function getStorefrontSalesChannelId(): string
    {
        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('parentId', null));

        $rootCategoryId = $this->categoryRepository->searchIds($criteria, new Context(new SystemSource()))->firstId();
        if ($rootCategoryId === null) {
            throw new \RuntimeException('Root category not found');
        }

        $navigationSalesChannelId = $this->connection->fetchOne('
            SELECT LOWER(HEX(`id`))
            FROM `sales_channel`
            WHERE `navigation_category_id` = UNHEX(:rootCategoryId)
            LIMIT 1;
        ', ['rootCategoryId' => $rootCategoryId]);
        if (!$navigationSalesChannelId) {
            throw new \RuntimeException('Sales channel not found');
        }

        return (string) $navigationSalesChannelId;
    }
}
