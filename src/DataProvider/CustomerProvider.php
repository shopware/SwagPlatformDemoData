<?php declare(strict_types=1);

namespace Swag\PlatformDemoData\DataProvider;

use Doctrine\DBAL\Connection;
use Shopware\Core\Defaults;

class CustomerProvider extends DemoDataProvider
{
    /**
     * @var Connection
     */
    private $connection;

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
        return 'customer';
    }

    public function getPayload(): array
    {
        $salutationId = $this->getSalutationId();
        $paymentMethodId = $this->getPaymentMethodId();
        $countryId = $this->getCountryId();

        return [
            [
                'id' => '6c97534c2c0747f39e8751e43cb2b013',
                'defaultPaymentMethodId' => $paymentMethodId,
                'salutationId' => $salutationId,
                'salesChannelId' => Defaults::SALES_CHANNEL,
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
                'groupId' => Defaults::FALLBACK_CUSTOMER_GROUP,
            ],
        ];
    }

    private function getSalutationId(): string
    {
        $result = $this->connection->fetchColumn('
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
        $result = $this->connection->fetchColumn('
            SELECT LOWER(HEX(`id`))
            FROM `payment_method`
            WHERE `active` = 1;
        ');

        if (!$result) {
            throw new \RuntimeException('No active payment method found, please make sure that basic data is available by running the migrations.');
        }

        return (string) $result;
    }

    private function getCountryId()
    {
        $result = $this->connection->fetchColumn('
            SELECT LOWER(HEX(`id`))
            FROM `country`
            WHERE `active` = 1;
        ');

        if (!$result) {
            throw new \RuntimeException('No active payment method found, please make sure that basic data is available by running the migrations.');
        }

        return (string) $result;
    }
}
