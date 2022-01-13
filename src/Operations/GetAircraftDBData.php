<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetAircraftDBData extends AbstractOperation
{
    protected $function = 'getAircraftDBData';

    /**
     * @return ResponseInterface
     */
    public function __invoke($aircraftDBId) {
        $this->getParams['acdb_id'] = $aircraftDBId;
        return $this->invokeMe();
    }
}
