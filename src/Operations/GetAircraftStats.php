<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetAircraftStats extends AbstractOperation
{
    protected $function = 'getAircraftStats';

    /**
     * @return ResponseInterface
     */
    public function __invoke($aircraftId) {
        $this->getParams['ac_id'] = $aircraftId;
        return $this->invokeMe();
    }
}
