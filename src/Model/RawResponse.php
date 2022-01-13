<?php

namespace FSAirlinesPhpIntegration\Model;

class RawResponse implements ResponseInterface
{
    /**
     * @var int
     */
    private $code = 0;

    /**
     * @var string
     */
    private $status = '';

    /**
     * @var string
     */
    private $body = '';

    /**
     * @var string
     */
    private $message = '';

    /**
     * @var string
     */
    private $contentType = '';

    /**
     * @param int $code
     * @param string $status
     * @param string $body
     * @param string $message
     * @param string $contentType
     */
    public function __construct(
        $code,
        $status,
        $body = '',
        $message = '',
        $contentType = ''
    ) {
        $this->code = $code;
        $this->status = $status;
        $this->body = $body;
        $this->message = $message;
        $this->contentType = $contentType;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return trim($this->body);
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    public function isError() {
        return $this->code >= 400;
    }
}
