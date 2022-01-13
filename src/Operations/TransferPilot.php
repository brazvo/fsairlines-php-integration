<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class TransferPilot extends AbstractOperation
{
    protected $function = 'transferPilot';

    /**
     * @return ResponseInterface
     */
    public function __invoke($pilotId, $loginToken, $icao) {
        $this->getParams['pilot_id'] = $pilotId;
        $this->getParams['token'] = $loginToken;
        $this->getParams['icao'] = $icao;
        return $this->invokeMe();
    }
}
