<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetFleetAircraftList extends AbstractOperation
{
    protected $function = 'getFleetAircraftList';

    /**
     * @return ResponseInterface
     */
    public function __invoke($fleetId) {
        $this->getParams['fleet_id'] = $fleetId;
        return $this->invokeMe();
    }
}
