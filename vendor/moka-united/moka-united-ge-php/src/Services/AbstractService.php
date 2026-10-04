<?php

namespace MokaUnitedGE\Services;

use MokaUnitedGE\Http\Response;
use MokaUnitedGE\MokaUnitedClient;

abstract class AbstractService
{
    /**
     * @var MokaUnitedClient
     */
    protected $client;

    /**
     * @param MokaUnitedClient $client
 */
    public function __construct(MokaUnitedClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $params
     * @param array $headers
     * @return Response
     */
    protected function request($method, $path, $params = [], $headers = []): Response
    {
        return $this->client->request($method, $path, $params, $headers);
    }

    /**
     * @return array
     */
    protected function getAuthorizationParams(): array
    {
        return $this->client->getAuthorizationParams();
    }
}
