<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetAirportPackageSummary extends AbstractOperation
{
    protected $function = 'getAirportPackageSummary';

    /**
     * @return ResponseInterface
     */
    public function __invoke($icao) {
        $this->getParams['icao'] = $icao;
        return $this->invokeMe();
    }
}
