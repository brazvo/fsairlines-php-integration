<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetPilotRatings extends AbstractOperation
{
    protected $function = 'getPilotRatings';

    /**
     * @return ResponseInterface
     */
    public function __invoke($pilotId) {
        $this->getParams['pilot_id'] = $pilotId;
        return $this->invokeMe();
    }
}
