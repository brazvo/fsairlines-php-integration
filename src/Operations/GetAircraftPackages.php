<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetAircraftPackages extends AbstractOperation
{
    protected $function = 'getAircraftPackages';

    /**
     * @return ResponseInterface
     */
    public function __invoke($aircraftId) {
        $this->getParams['ac_id'] = $aircraftId;
        return $this->invokeMe();
    }
}
