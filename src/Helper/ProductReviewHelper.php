<?php

declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PlatformDemoData\Helper;

use Shopware\Core\Framework\Log\Package;
use Swag\PlatformDemoData\DataProvider\CustomerProvider;

#[Package('fundamentals@after-sales')]
class ProductReviewHelper
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public function createReviews(string $salesChannelId, string $languageId, string $productIdSuffix): array
    {
        return [
            [
                'id' => 'bc3b8f5a91294148bd9e' . $productIdSuffix,
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Very good',
                'content' => 'Excellent product! The quality is top notch, everything works perfectly and exceeds my expectations. I definitely recommend buying it.',
                'points' => 5.0,
                'status' => true,
            ],
            [
                'id' => '6b9697a1bc474bbba746' . $productIdSuffix,
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Outstanding Quality',
                'content' => 'Top product! High-quality build, easy to use, and fast delivery. I would buy it again anytime',
                'points' => 5.0,
                'status' => true,
            ],
            [
                'id' => '3252705de9f74c978378' . $productIdSuffix,
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Exceeded Expectations',
                'content' => 'Absolutely delighted. Exactly as described, even better than expected.',
                'points' => 5.0,
                'status' => true,
            ],
            [
                'id' => 'e14609c74a8846f49b72' . $productIdSuffix,
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Perfect Choice',
                'content' => 'Perfect! Exactly what I was looking for. Works flawlessly.',
                'points' => 5.0,
                'status' => true,
            ],
            [
                'id' => '069bbd0bc4be4cc48010' . $productIdSuffix,
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Good',
                'content' => 'Very good product with minor flaws. Overall, I am satisfied; it offers good value for money.',
                'points' => 4.0,
                'status' => true,
            ],
            [
                'id' => 'aaf8cfcfdb2a4119940a' . $productIdSuffix,
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Very Solid Product',
                'content' => 'Overall a very good product. Minor flaws, but nothing serious.',
                'points' => 4.0,
                'status' => true,
            ],
            [
                'id' => '558ebb6881ee4be4ace0' . $productIdSuffix,
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Great Value for Money',
                'content' => 'Solid product with good value for money. I would recommend it.',
                'points' => 4.0,
                'status' => true,
            ],
            [
                'id' => '6db0c9a73d08467fadd6' . $productIdSuffix,
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Satisfactory',
                'content' => 'The product is fine, serves its purpose, but there is nothing special about it. Acceptable for the price.',
                'points' => 3.0,
                'status' => true,
            ],
            [
                'id' => 'a677a16c9db945f6ae39' . $productIdSuffix,
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Does the Job',
                'content' => 'Okay for everyday use. Does its job, but there are definitely better alternatives.',
                'points' => 3.0,
                'status' => true,
            ],
            [
                'id' => '29342e2bb0a742429e46' . $productIdSuffix,
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Average Experience',
                'content' => 'Average. Neither particularly good nor particularly bad.',
                'points' => 3.0,
                'status' => true,
            ],
            [
                'id' => 'e7f51983ff5f44848ed2' . $productIdSuffix,
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Poor',
                'content' => 'Unfortunately disappointing. The quality is mediocre and there were several problems during use.',
                'points' => 2.0,
                'status' => true,
            ],
            [
                'id' => 'e52d82f3f8344b7f9de0' . $productIdSuffix,
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Disappointing Durability',
                'content' => 'Unfortunately not very durable. Problems appeared after a short time.',
                'points' => 2.0,
                'status' => true,
            ],
            [
                'id' => 'ef18e5dba80a4bd6a933' . $productIdSuffix,
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Good Idea, Weak Execution',
                'content' => 'The idea is good, but the execution is lacking.',
                'points' => 2.0,
                'status' => true,
            ],
            [
                'id' => '3569e6d6fde14c4c956d' . $productIdSuffix,
                'salesChannelId' => $salesChannelId,
                'customerId' => CustomerProvider::CUSTOMER_ID,
                'languageId' => $languageId,
                'title' => 'Very poor',
                'content' => 'Absolutely not recommended. The product is defective, does not work as described and appears to be cheaply made.',
                'points' => 1.0,
                'status' => true,
            ],
            [
                'id' => 'bb335ee68add4f8a9f23' . $productIdSuffix,
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
