<?php

namespace FSAirlinesPhpIntegration\Model;

interface ResponseInterface
{
    const STATUS_SUCCESS = 'SUCCESS';
    const STATUS_NOT_FOUND = 'NOT FOUND';
    const STATUS_FLIGHT_BOOKED = 'FLIGHT BOOKED';
    const STATUS_GROUNDED = 'GROUNDED';
    const STATUS_SUSPENDED = 'SUSPENDED';
    const STATUS_VA_INACTIVE = 'VA INACTIVE';
    const STATUS_INSUFFICIENT_FUNDS = 'INSUFFICIENT FUNDS';

    /**
     * @return int
     */
    public function getCode();

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @return mixed
     */
    public function getBody();

    /**
     * @return string
     */
    public function getMessage();

    /**
     * @return string
     */
    public function getContentType();

    /**
     * @return boolean
     */
    public function isError();
}
