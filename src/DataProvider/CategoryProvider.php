<?php declare(strict_types=1);

namespace Swag\PlatformDemoData\DataProvider;

use Doctrine\DBAL\Connection;
use Shopware\Core\Content\Category\CategoryEntity;
use Shopware\Core\Framework\Api\Context\SystemSource;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Uuid\Uuid;
use Swag\PlatformDemoData\Resources\helper\TranslationHelper;

class CategoryProvider extends DemoDataProvider
{
    private EntityRepositoryInterface $categoryRepository;

    private Connection $connection;

    private TranslationHelper $translationHelper;

    public function __construct(EntityRepositoryInterface $categoryRepository, Connection $connection)
    {
        $this->categoryRepository = $categoryRepository;
        $this->connection = $connection;
        $this->translationHelper = new TranslationHelper($connection);
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
        $cmsPageId = $this->getDefaultCmsListingPageId();

        return [
            [
                'id' => $this->getRootCategoryId(),
                'cmsPageId' => '695477e02ef643e5a016b83ed4cdf63a',
                'active' => true,
                'displayNestedProducts' => true,
                'visible' => true,
                'type' => 'page',
                'name' => $this->translationHelper->adjustTranslations([
                    'de-DE' => 'Katalog #1',
                    'en-GB' => 'Catalogue #1',
                ]),
                'children' => [
                    [
                        'id' => '77b959cf66de4c1590c7f9b7da3982f3',
                        'cmsPageId' => $cmsPageId,
                        'active' => false,
                        'displayNestedProducts' => true,
                        'visible' => true,
                        'type' => 'page',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Lebensmittel',
                            'en-GB' => 'Food',
                        ]),
                        'children' => [
                            [
                                'id' => '19ca405790ff4f07aac8c599d4317868',
                                'cmsPageId' => $cmsPageId,
                                'active' => true,
                                'displayNestedProducts' => true,
                                'visible' => true,
                                'type' => 'page',
                                'name' => $this->translationHelper->adjustTranslations([
                                    'de-DE' => 'Backwaren',
                                    'en-GB' => 'Bakery products',
                                ]),
                            ],
                            [
                                'id' => '48f97f432fd041388b2630184139cf0e',
                                'cmsPageId' => $cmsPageId,
                                'active' => true,
                                'displayNestedProducts' => true,
                                'visible' => true,
                                'type' => 'page',
                                'afterCategoryId' => '19ca405790ff4f07aac8c599d4317868',
                                'name' => $this->translationHelper->adjustTranslations([
                                    'de-DE' => 'Fisch',
                                    'en-GB' => 'Fish',
                                ]),
                            ],
                            [
                                'id' => 'bb22b05bff9140f3808b1cff975b75eb',
                                'cmsPageId' => $cmsPageId,
                                'active' => true,
                                'displayNestedProducts' => true,
                                'visible' => true,
                                'type' => 'page',
                                'afterCategoryId' => '48f97f432fd041388b2630184139cf0e',
                                'name' => $this->translationHelper->adjustTranslations([
                                    'de-DE' => 'Süßes',
                                    'en-GB' => 'Sweets',
                                ]),
                            ],
                        ],
                    ],
                    [
                        'id' => 'a515ae260223466f8e37471d279e6406',
                        'cmsPageId' => $cmsPageId,
                        'active' => true,
                        'displayNestedProducts' => true,
                        'visible' => true,
                        'type' => 'page',
                        'afterCategoryId' => '77b959cf66de4c1590c7f9b7da3982f3',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Bekleidung',
                            'en-GB' => 'Clothing',
                        ]),
                        'children' => [
                            [
                                'id' => '8de9b484c54f441c894774e5f57e485c',
                                'cmsPageId' => $cmsPageId,
                                'active' => true,
                                'displayNestedProducts' => true,
                                'visible' => true,
                                'type' => 'page',
                                'name' => $this->translationHelper->adjustTranslations([
                                    'de-DE' => 'Damen',
                                    'en-GB' => 'Women',
                                ]),
                            ],
                            [
                                'id' => '2185182cbbd4462ea844abeb2a438b33',
                                'cmsPageId' => $cmsPageId,
                                'active' => true,
                                'displayNestedProducts' => true,
                                'visible' => true,
                                'type' => 'page',
                                'afterCategoryId' => '8de9b484c54f441c894774e5f57e485c',
                                'name' => $this->translationHelper->adjustTranslations([
                                    'de-DE' => 'Herren',
                                    'en-GB' => 'Men',
                                ]),
                            ],
                        ],
                    ],
                    [
                        'id' => '251448b91bc742de85643f5fccd89051',
                        'cmsPageId' => $cmsPageId,
                        'active' => true,
                        'displayNestedProducts' => true,
                        'visible' => true,
                        'type' => 'page',
                        'afterCategoryId' => 'a515ae260223466f8e37471d279e6406',
                        'name' => $this->translationHelper->adjustTranslations([
                            'de-DE' => 'Freizeit & Elektro',
                            'en-GB' => 'Free time & electronics',
                        ]),
                    ],
                ],
            ],
        ];
    }

    private function getRootCategoryId(): string
    {
        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('parentId', null));

        /** @var CategoryEntity|null $rootCategory */
        $rootCategory = $this->categoryRepository->search($criteria, new Context(new SystemSource()))->first();
        if (!$rootCategory) {
            throw new \RuntimeException('Root category not found');
        }

        return $rootCategory->getId();
    }

    private function getDefaultCmsListingPageId(): string
    {
        $result = $this->connection->fetchOne(
            '
                SELECT cms_page_id
                FROM cms_page_translation
                INNER JOIN cms_page ON cms_page.id = cms_page_translation.cms_page_id
                WHERE cms_page.locked
                AND name = :name
            ',
            ['name' => 'Default listing layout']
        );

        if ($result === false) {
            throw new \RuntimeException('Default Cms Listing page not found');
        }

        return Uuid::fromBytesToHex((string) $result);
    }
}
