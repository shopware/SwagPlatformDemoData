<?php declare(strict_types=1);

namespace Swag\PlatformDemoData;

use Shopware\Core\Framework\Api\Controller\SyncController;
use Shopware\Core\Framework\Context;
use Shopware\Core\PlatformRequest;
use Swag\PlatformDemoData\DataProvider\DemoDataProvider;
use Symfony\Component\HttpFoundation\Request;

class DemoDataService
{
    /**
     * @var SyncController
     */
    private $sync;

    /**
     * @var DemoDataProvider[]
     */
    private $demoDataProvider;

    public function __construct(SyncController $sync, iterable $demoDataProvider)
    {
        $this->sync = $sync;
        $this->demoDataProvider = $demoDataProvider;
    }

    public function generate(Context $context): void
    {
        /** @var DemoDataProvider $dataProvider */
        foreach ($this->demoDataProvider as $dataProvider) {
            $payload = [
                [
                    'action' => $dataProvider->getAction(),
                    'entity' => $dataProvider->getEntity(),
                    'payload' => $dataProvider->getPayload()
                ]
            ];

            $response  = $this->sync->sync(new Request([], [], [], [], [], [], json_encode($payload)), $context, PlatformRequest::API_VERSION);
            $result = json_decode($response->getContent(), true);

            if (isset($result['errors']) && count($result['errors']) > 0) {
                throw new \RuntimeException(sprintf('Error importing "%s": %s', $dataProvider->getEntity(), print_r($result['errors'], true)));
            }

            $dataProvider->finalize($context);
        }
    }
}
