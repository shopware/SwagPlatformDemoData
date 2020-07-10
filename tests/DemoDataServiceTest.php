<?php declare(strict_types=1);

namespace Swag\PlatformDemoDataTests;

use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;
use Swag\PlatformDemoData\DemoDataService;

class DemoDataServiceTest extends TestCase
{
    use IntegrationTestBehaviour;

    public function testGenerate(): void
    {
        $demoDataService = $this->getContainer()->get(DemoDataService::class);

        $demoDataService->generate($this->getContainer(), Context::createDefaultContext());

        // Nothing broke so far, generation should be fine
        static::assertTrue(true);
    }
}
