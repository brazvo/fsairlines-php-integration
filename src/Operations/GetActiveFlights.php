<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetActiveFlights extends AbstractOperation
{
    protected $function = 'getActiveFlights';

    /**
     * @return ResponseInterface
     */
    public function __invoke() {
        return $this->invokeMe();
    }
}
