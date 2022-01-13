<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetPilotHours extends AbstractOperation
{
    protected $function = 'getPilotHours';

    /**
     * @return ResponseInterface
     */
    public function __invoke($pilotId) {
        $this->getParams['pilot_id'] = $pilotId;
        return $this->invokeMe();
    }
}
