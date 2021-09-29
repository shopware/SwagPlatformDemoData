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
    private SyncController $sync;

    /**
     * @var DemoDataProvider[]
     */
    private array $demoDataProvider;

    private RequestStack $requestStack;

    private string $env;

    public function __construct(SyncController $sync, iterable $demoDataProvider, RequestStack $requestStack, string $env)
    {
        $this->sync = $sync;
        $this->demoDataProvider = \is_array($demoDataProvider) ? $demoDataProvider : \iterator_to_array($demoDataProvider);
        $this->requestStack = $requestStack;
        $this->env = $env;
    }

    public function generate(Context $context): void
    {
        foreach ($this->demoDataProvider as $dataProvider) {
            $payload = [
                [
                    'action' => $dataProvider->getAction(),
                    'entity' => $dataProvider->getEntity(),
                    'payload' => $dataProvider->getPayload(),
                ],
            ];

            $request = new Request([], [], [], [], [], [], \json_encode($payload, JSON_THROW_ON_ERROR));
            // ignore deprecations in prod
            if ($this->env !== 'prod') {
                $request->headers->set(PlatformRequest::HEADER_IGNORE_DEPRECATIONS, 'true');
            }
            $request->headers->set(PlatformRequest::HEADER_FAIL_ON_ERROR, 'false');

            $this->requestStack->push($request);
            $response = $this->sync->sync($request, $context);
            $this->requestStack->pop();

            $result = \json_decode((string) $response->getContent(), true);

            if ($response->getStatusCode() >= 400) {
                throw new \RuntimeException(\sprintf('Error importing "%s": %s', $dataProvider->getEntity(), \print_r($result, true)));
            }

            $dataProvider->finalize($context);
        }
    }

    public function delete(Context $context): void
    {
        foreach ($this->demoDataProvider as $dataProvider) {
            $payloadsIds = [];
            foreach ($dataProvider->getPayload() as $entry) {
                if ($dataProvider->getEntity() === 'category' && isset($entry['children'])) {
                    foreach ($entry['children'] as $child) {
                        $payloadsIds[] = ['id' => $child['id']];
                    }
                } else {
                    $payloadsIds[] = ['id' => $entry['id']];
                }
            }

            $payload = [
                [
                    'action' => 'delete',
                    'entity' => $dataProvider->getEntity(),
                    'payload' => $payloadsIds,
                ],
            ];

            $request = new Request([], [], [], [], [], [], \json_encode($payload, JSON_THROW_ON_ERROR));
            // ignore deprecations in prod
            if ($this->env !== 'prod') {
                $request->headers->set(PlatformRequest::HEADER_IGNORE_DEPRECATIONS, 'true');
            }
            $request->headers->set(PlatformRequest::HEADER_FAIL_ON_ERROR, 'false');

            $this->requestStack->push($request);
            $response = $this->sync->sync($request, $context);
            $this->requestStack->pop();

            $result = \json_decode((string)$response->getContent(), true);

            if ($response->getStatusCode() >= 400) {
                throw new \RuntimeException(\sprintf('Error deleting "%s": %s', $dataProvider->getEntity(), \print_r($result, true)));
            }
        }
    }
}
