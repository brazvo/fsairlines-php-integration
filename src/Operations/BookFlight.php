<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class BookFlight extends AbstractOperation
{
    protected $function = 'bookFlight';

    /**
     * @return ResponseInterface
     */
    public function __invoke($pilotId, $loginToken, $routeId, $aircraftId) {
        $this->getParams['pilot_id'] = $pilotId;
        $this->getParams['token'] = $loginToken;
        $this->getParams['route_id'] = $routeId;
        $this->getParams['ac_id'] = $aircraftId;
        return $this->invokeMe();
    }
}
