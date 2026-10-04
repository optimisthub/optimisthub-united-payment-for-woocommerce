<?php

namespace MokaUnitedGE\Http;

use InvalidArgumentException;
use RuntimeException;

class Http
{
    /**
     * Executes the given request via cURL.
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function request(Request $request): Response
    {
        $curl = curl_init();

        if ($curl === false) {
            throw new RuntimeException('Unable to initialize cURL.');
        }

        curl_setopt_array($curl, [
            CURLOPT_URL => $request->getUrl(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_HTTPHEADER => $request->getHeaders(),
            CURLOPT_HEADER => true,
        ]);

        switch ($request->getMethod()) {
            case Request::METHOD_POST:
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $request->getContent());
                break;
            case Request::METHOD_PUT:
            case Request::METHOD_PATCH:
            case Request::METHOD_DELETE:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $request->getMethod());
                curl_setopt($curl, CURLOPT_POSTFIELDS, $request->getContent());
                break;
            case Request::METHOD_GET:
                break;
            default:
                curl_close($curl);
                throw new InvalidArgumentException('HTTP method "' . $request->getMethod() . '" is not supported.');
        }

        $rawResponse = curl_exec($curl);

        if ($rawResponse === false) {
            $error = curl_error($curl);
            curl_close($curl);
            throw new RuntimeException('cURL error: ' . ($error ?: 'Unknown error'));
        }

        $status = (int)curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $headerSize = (int)curl_getinfo($curl, CURLINFO_HEADER_SIZE);

        $headerString = substr($rawResponse, 0, $headerSize);
        $body = substr($rawResponse, $headerSize);

        curl_close($curl);

        if ($status >= 400) {
            throw new RuntimeException("HTTP Error {$status}: {$body}", $status);
        }

        return new Response($body, $status, $this->parseHeaders($headerString));
    }

    /**
     * @param string $headerString
     * @return array
     */
    private function parseHeaders($headerString)
    {
        if ($headerString === '') {
            return [];
        }

        $headers = [];
        $segments = preg_split("/\r\n\r\n/", trim($headerString));
        $lastSegment = $segments ? array_pop($segments) : '';
        $lines = $lastSegment !== '' ? preg_split("/\r\n/", $lastSegment) : [];

        foreach ($lines as $line) {
            if (strpos($line, ':') === false) {
                continue;
            }

            [$name, $value] = explode(':', $line, 2);
            $headers[trim($name)] = trim($value);
        }

        return $headers;
    }
}
