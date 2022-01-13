<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Decorator\JsonResponseDecorator;
use FSAirlinesPhpIntegration\Model\JsonResponse;
use FSAirlinesPhpIntegration\Model\RawResponse;
use FSAirlinesPhpIntegration\Model\ResponseInterface;
use Httpful\Httpful;

abstract class AbstractOperation
{
    /**
     * Must by overriden in child
     *
     * @var string
     */
    protected $function = '';

    /**
     * @var string
     */
    protected $apiUrl;

    /**
     * @var
     */
    protected $rawData = FALSE;

    /**
     * @var array
     */
    protected $getParams = [];

    /**
     * @param $apiUrl
     * @param $apiToken
     * @param $airlineId
     * @param $pilotId
     * @param $rawData
     * @param $rawDataFormat
     */
    public function __construct(
        $apiUrl,
        $apiToken,
        $airlineId,
        $pilotId,
        $rawData,
        $rawDataFormat
    ) {
        $this->apiUrl = $apiUrl;
        $this->rawData = $rawData;
        $this->getParams['format'] = !$rawData ? 'json' : $rawDataFormat;
        $this->getParams['apikey'] = $apiToken;
        $this->getParams['va_id'] = $airlineId;
        if ($pilotId) {
            $this->getParams['pilot_id'] = $pilotId;
        }
    }

    protected function invokeMe() {
        $response = $this->get();

        return $response;
    }

    /**
     * @param $url
     * @param array $data
     * @return ResponseInterface
     */
    protected function get(array $data = []) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->createRequestUrl());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (count($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        }
        $response = curl_exec($ch);

        if ($error = $this->checkResponseError($ch)) {
            return $error;
        }

        $result = $this->getResponse($ch, $response);

        curl_close($ch);

        return $result;
    }

    /**
     * @param $url
     * @param array $data
     * @return ResponseInterface
     */
    protected function post(array $data = []) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->createRequestUrl());
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($ch);

        if ($error = $this->checkResponseError($ch)) {
            return $error;
        }

        $result = $this->getResponse($ch, $response);

        curl_close($ch);

        return $result;
    }

    /**
     * @return string
     */
    protected function createRequestUrl() {
        $this->getParams['function'] = $this->function;
        $query = http_build_query($this->getParams);

        return $this->apiUrl . '?' . $query;
    }

    /**
     * @param $curlHandler
     * @param string $data
     * @return ResponseInterface
     */
    private function getResponse($curlHandler, $data) {
        $info = curl_getinfo($curlHandler);

        $responseHttpCode = $info['http_code'];
        if (preg_match('/NOT FOUND/', $data)) {
            $responseHttpCode = 404;
        }

       $response = new RawResponse(
            $responseHttpCode,
            ($responseHttpCode < 400 ? 'OK' : 'FAILED'),
            $data,
            '',
            $info['content_type']
        );

        if (!$this->rawData) {
            return new JsonResponseDecorator($response);
        }

        return $response;
    }

    /**
     * @param $curlHandler
     * @return ResponseInterface|null
     */
    private function checkResponseError($curlHandler) {
        if (curl_errno($curlHandler)) {
            return new RawResponse(
                500,
                'REQUEST_ERROR',
                curl_error($curlHandler)
            );
        }

        return null;
    }
}
