<?php

declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PlatformDemoData\Resources\helper;

use Shopware\Core\Framework\Log\Package;
use Shopware\Core\Framework\Uuid\Uuid;
use Swag\PlatformDemoData\DataProvider\CustomerProvider;

#[Package('fundamentals@after-sales')]
class ProductReviewHelper
{
    public function createReviews(string $salesChannelId, string $languageId): array
    {
        return [
            [
                'id' => Uuid::randomHex(),
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Very good',
                'content' => 'Excellent product! The quality is top notch, everything works perfectly and exceeds my expectations. I definitely recommend buying it.',
                'points' => 5.0,
                'status' => true,
            ],
            [
                'id' => Uuid::randomHex(),
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Good',
                'content' => 'Very good product with minor flaws. Overall, I am satisfied; it offers good value for money.',
                'points' => 4.0,
                'status' => true,
            ],
            [
                'id' => Uuid::randomHex(),
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Satisfactory',
                'content' => 'The product is fine, serves its purpose, but there is nothing special about it. Acceptable for the price.',
                'points' => 3.0,
                'status' => true,
            ],
            [
                'id' => Uuid::randomHex(),
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Poor',
                'content' => 'Unfortunately disappointing. The quality is mediocre and there were several problems during use.',
                'points' => 2.0,
                'status' => true,
            ],
            [
                'id' => Uuid::randomHex(),
                'productId' => '',
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Very poor',
                'content' => 'Absolutely not recommended. The product is defective, does not work as described and appears to be cheaply made.',
                'points' => 1.0,
                'status' => true,
            ],
        ];
    }
}