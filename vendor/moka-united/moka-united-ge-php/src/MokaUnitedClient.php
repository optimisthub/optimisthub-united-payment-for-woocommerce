<?php

namespace MokaUnitedGE;

use MokaUnitedGE\Http\Http;
use MokaUnitedGE\Http\Request;
use MokaUnitedGE\Http\Response;
use MokaUnitedGE\Services\CardService;
use MokaUnitedGE\Services\PaymentService;
use MokaUnitedGE\Services\RefundService;

class MokaUnitedClient
{
    /**
     * @var string default base URL
     */
    public const DEFAULT_API_BASE = 'https://service.unitedpayment.ge';

    /**
     * @var string
     */
    private $baseUrl = self::DEFAULT_API_BASE;

    /**
     * @var string
     */
    private $dealerCode;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var array
     */
    private $services = [];

    /**
     * @var Http
     */
    private $http;

    /**
     * @param array $options
     * @param Http|null $http
     * @return void
     */
    public function __construct($options = [], ?Http $http = null)
    {
        $this->dealerCode = $options['dealerCode'] ?? $this->dealerCode;
        $this->username = $options['username'] ?? $this->username;
        $this->password = $options['password'] ?? $this->password;
        $this->baseUrl = $options['baseUrl'] ?? $this->baseUrl;
        $this->http = $http ?? new Http();
    }

    /**
     * Returns the base Url of the API endpoint.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $method The HTTP method being used
     * @param string $path
     * @param array|object $payload  Key-value pairs for parameters. | JsonSerializable
     * @param array $headers Headers to be used in the request
     * @return Response
     */
    public function request($method, $path, $payload, $headers): Response
    {
        $request = new Request($this->prepareRequestUrl($path), $method);
        $request->setHeaders($this->prepareRequestHeaders($headers));
        $request->setContent(json_encode($payload));

        return $this->http->request($request);
    }

    /**
     * @return array
     */
    public function getAuthorizationParams()
    {
        return [
            'DealerCode' => $this->dealerCode,
            'Username' => $this->username,
            'Password' => $this->password,
            'CheckKey' => $this->generateCheckKey()
        ];
    }

    /**
     * @return string
     */
    protected function generateCheckKey()
    {
        return hash('sha256', $this->dealerCode . 'MK' . $this->username . 'PD' . $this->password);
    }

    /**
     * @param string $path
     * @return string
     */
    private function prepareRequestUrl($path)
    {
        return $this->getBaseUrl() . $path;
    }

    /**
     * @param array $headers
     * @return array
     */
    private function prepareRequestHeaders($headers)
    {
        return array_merge([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ], $headers);
    }

    /**
     * @return CardService
     */
    public function cards(): CardService
    {
        return $this->services['cards'] ??= new CardService($this);
    }

    /**
     * @return PaymentService
     */
    public function payments(): PaymentService
    {
        return $this->services['payments'] ??= new PaymentService($this);
    }

    /**
     * @return RefundService
     */
    public function refunds(): RefundService
    {
        return $this->services['refunds'] ??= new RefundService($this);
    }
}
