<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetPilotStatus extends AbstractOperation
{
    protected $function = 'getPilotStatus';

    /**
     * @return ResponseInterface
     */
    public function __invoke($pilotId) {
        $this->getParams['pilot_id'] = $pilotId;
        return $this->invokeMe();
    }
}
