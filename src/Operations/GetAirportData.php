<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetAirportData extends AbstractOperation
{
    protected $function = 'getAirportData';

    /**
     * @return ResponseInterface
     */
    public function __invoke($icao) {
        $this->getParams['icao'] = $icao;
        return $this->invokeMe();
    }
}
