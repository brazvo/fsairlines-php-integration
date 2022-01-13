<?php

namespace FSAirlinesPhpIntegration\Decorator;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class JsonResponseDecorator implements ResponseInterface
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->response->getCode();
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->response->getStatus();
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->response->getBody()
            ? json_decode($this->response->getBody(), true)
            : [];
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->response->getMessage();
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->response->getMessage();
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return $this->response->isError();
    }
}
