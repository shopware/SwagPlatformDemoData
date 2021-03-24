<?php declare(strict_types=1);

namespace Swag\PlatformDemoData;

use Shopware\Core\Framework\Api\Controller\SyncController;
use Shopware\Core\Framework\Context;
use Shopware\Core\PlatformRequest;
use Swag\PlatformDemoData\DataProvider\DemoDataProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

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

    /**
     * @var RequestStack
     */
    private $requestStack;
    /**
     * @var string
     */
    private $env;

    public function __construct(SyncController $sync, iterable $demoDataProvider, RequestStack $requestStack, string $env)
    {
        $this->sync = $sync;
        $this->demoDataProvider = $demoDataProvider;
        $this->requestStack = $requestStack;
        $this->env = $env;
    }

    public function generate(Context $context): void
    {
        /** @var DemoDataProvider $dataProvider */
        foreach ($this->demoDataProvider as $dataProvider) {
            $payload = [
                [
                    'action' => $dataProvider->getAction(),
                    'entity' => $dataProvider->getEntity(),
                    'payload' => $dataProvider->getPayload(),
                ],
            ];

            $request = new Request([], [], [], [], [], [], json_encode($payload));
            // ignore deprecations in prod
            if ($this->env !== 'prod') {
                $request->headers->set(PlatformRequest::HEADER_IGNORE_DEPRECATIONS, 'true');
            }

            $this->requestStack->push($request);
            $response = $this->sync->sync($request, $context);
            $this->requestStack->pop();

            $result = json_decode($response->getContent(), true);

            if ($response->getStatusCode() >= 400) {
                throw new \RuntimeException(sprintf('Error importing "%s": %s', $dataProvider->getEntity(), print_r($result, true)));
            }

            $dataProvider->finalize($context);
        }
    }
}
