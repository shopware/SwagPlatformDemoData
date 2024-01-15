<?php

declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PlatformDemoData;

use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Shopware\Core\Framework\Api\Controller\SyncController;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\Write\Validation\RestrictDeleteViolationException;
use Shopware\Core\Framework\Log\Package;
use Swag\PlatformDemoData\DataProvider\DemoDataProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

#[Package('services-settings')]
class DemoDataService
{
    private SyncController $sync;

    /**
     * @var iterable<DemoDataProvider>
     */
    private iterable $demoDataProvider;

    private RequestStack $requestStack;

    /**
     * @param iterable<DemoDataProvider> $demoDataProvider
     */
    public function __construct(SyncController $sync, iterable $demoDataProvider, RequestStack $requestStack)
    {
        $this->sync = $sync;
        $this->demoDataProvider = $demoDataProvider;
        $this->requestStack = $requestStack;
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

            try {
                $this->requestStack->push($request);
                $response = $this->sync->sync($request, $context);
                $this->requestStack->pop();

                $result = \json_decode((string) $response->getContent(), true);

                if ($response->getStatusCode() >= 400) {
                    throw new \RuntimeException(\sprintf('Error deleting "%s": %s', $dataProvider->getEntity(), \print_r($result, true)));
                }
            } catch (RestrictDeleteViolationException|ForeignKeyConstraintViolationException) {
                // ignore
            }
        }
    }
}
