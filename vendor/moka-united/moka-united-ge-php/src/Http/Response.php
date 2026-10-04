<?php

namespace MokaUnitedGE\Http;

class Response
{
    /**
     * @var string
     */
    protected $body;

    /**
     * @var int
     */
    protected $statusCode;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var array|null
     */
    protected $data = null;

    /**
     * @var string|null
     */
    protected $resultCode = null;

    /**
     * @var string|null
     */
    protected $resultMessage = null;

    /**
     * @var mixed|null
     */
    protected $exception = null;

    /**
     * @param string $body
     * @param int $statusCode
     * @param array $headers
     */
    public function __construct($body, $statusCode, $headers = [])
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
        $this->headers = $headers;

        $this->parseBody();
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function getHeader($name)
    {
        $headers = strtolower($name);

        foreach ($this->headers as $headerName => $headerValue) {
            if (strtolower($headerName) === $headers) {
                return $headerValue;
            }
        }

        return null;
    }

    /**
     * @return array|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string|null
     */
    public function getResultCode()
    {
        return $this->resultCode;
    }

    /**
     * @return string|null
     */
    public function getResultMessage()
    {
        return $this->resultMessage;
    }

    /**
     * @return mixed|null
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return ($this->statusCode >= 200 && $this->statusCode < 400 && $this->resultCode === 'Success');
    }

    /**
     * Parses the response body for known API structure.
     *
     * @return void
     */
    protected function parseBody()
    {
        $decoded = json_decode($this->body, true);

        if (!is_array($decoded)) {
            return;
        }

        $this->data = isset($decoded['Data']) ? $decoded['Data'] : null;
        $this->resultCode = isset($decoded['ResultCode']) ? $decoded['ResultCode'] : null;
        $this->resultMessage = isset($decoded['ResultMessage']) ? $decoded['ResultMessage'] : null;
        $this->exception = isset($decoded['Exception']) ? $decoded['Exception'] : null;
    }
}
