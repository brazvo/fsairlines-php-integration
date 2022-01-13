<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class CancelFlight extends AbstractOperation
{
    protected $function = 'cancelFlight';

    /**
     * @return ResponseInterface
     */
    public function __invoke($pilotId, $loginToken) {
        $this->getParams['ac_id'] = $aircraftId;
        $this->getParams['token'] = $loginToken;
        return $this->invokeMe();
    }
}
