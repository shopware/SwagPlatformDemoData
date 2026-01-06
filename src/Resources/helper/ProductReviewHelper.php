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
                'title' => 'Outstanding Quality',
                'content' => 'Top product! High-quality build, easy to use, and fast delivery. I would buy it again anytime',
                'points' => 5.0,
                'status' => true,
            ],
            [
                'id' => Uuid::randomHex(),
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Exceeded Expectations',
                'content' => 'Absolutely delighted. Exactly as described, even better than expected.',
                'points' => 5.0,
                'status' => true,
            ],
            [
                'id' => Uuid::randomHex(),
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Perfect Choice',
                'content' => 'Perfect! Exactly what I was looking for. Works flawlessly.',
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
                'title' => 'Very Solid Product',
                'content' => 'Overall a very good product. Minor flaws, but nothing serious.',
                'points' => 4.0,
                'status' => true,
            ],
            [
                'id' => Uuid::randomHex(),
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Great Value for Money',
                'content' => 'Solid product with good value for money. I would recommend it.',
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
                'title' => 'Does the Job',
                'content' => 'Okay for everyday use. Does its job, but there are definitely better alternatives.',
                'points' => 3.0,
                'status' => true,
            ],
            [
                'id' => Uuid::randomHex(),
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Average Experience',
                'content' => 'Average. Neither particularly good nor particularly bad.',
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
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Disappointing Durability',
                'content' => 'Unfortunately not very durable. Problems appeared after a short time.',
                'points' => 2.0,
                'status' => true,
            ],
            [
                'id' => Uuid::randomHex(),
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Good Idea, Weak Execution',
                'content' => 'The idea is good, but the execution is lacking.',
                'points' => 2.0,
                'status' => true,
            ],
            [
                'id' => Uuid::randomHex(),
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Very poor',
                'content' => 'Absolutely not recommended. The product is defective, does not work as described and appears to be cheaply made.',
                'points' => 1.0,
                'status' => true,
            ],
            [
                'id' => Uuid::randomHex(),
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Not Worth It',
                'content' => 'Very disappointing. Poor quality and not functional upon delivery.',
                'points' => 1.0,
                'status' => true,
            ],
        ];
    }
}