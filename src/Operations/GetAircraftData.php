<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetAircraftData extends AbstractOperation
{
    protected $function = 'getAircraftData';

    /**
     * @return ResponseInterface
     */
    public function __invoke($aircraftId) {
        $this->getParams['ac_id'] = $aircraftId;
        return $this->invokeMe();
    }
}
