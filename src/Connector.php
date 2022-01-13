<?php

namespace FSAirlinesPhpIntegration;


final class Connector
{
    /**
     * @var string
     */
    private $apiKey = '';

    /**
     * @var string
     */
    private $apiUrl = 'https://www.fsairlines.net/va_interface2.php';

    /**
     * @var string
     */
    private $airlineId = '';

    /**
     * @var OperationLoader
     */
    private $operationLoader;

    /**
     * @var bool
     */
    private $rawData = FALSE;

    /**
     * @var string json | xml
     */
    private $rawDataFormat = 'json';

    /**
     * @param string $apiKey
     * @param string $apiUrl
     * @param string $airlineId
     * @param string $pilotId
     */
    public function __construct(
        $apiKey,
        $airlineId
    ) {
        $this->apiKey = $apiKey;
        $this->airlineId = $airlineId;
    }

    /**
     * @param string $apiUrl
     * @return Connector
     */
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    /**
     * @param string $apiKey
     * @return Connector
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @param string $airlineId
     * @return Connector
     */
    public function setAirlineId($airlineId)
    {
        $this->airlineId = $airlineId;
        return $this;
    }

    /**
     * If TRUE, data will be responded as json or xml string
     *
     * @param bool $rawData
     * @return Connector
     */
    public function setRawData($rawData)
    {
        $this->rawData = $rawData;
        return $this;
    }

    /**
     * Set format of data when rawData is set to TRUE: json | xml
     *
     * @param string $rawDataFormat json | xml
     * @return Connector
     */
    public function setRawDataFormat($rawDataFormat)
    {
        $this->rawDataFormat = $rawDataFormat;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @return string
     */
    public function getAirlineId()
    {
        return $this->airlineId;
    }

    /**
     * @return bool
     */
    public function isRawData()
    {
        return $this->rawData;
    }

    /**
     * @return string
     */
    public function getRawDataFormat()
    {
        return $this->rawDataFormat;
    }

    public function operation() {
        return new OperationLoader($this);
    }
}
