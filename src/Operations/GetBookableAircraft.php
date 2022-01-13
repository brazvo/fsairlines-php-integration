<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetBookableAircraft extends AbstractOperation
{
    protected $function = 'getBookableAircraft';

    /**
     * @return ResponseInterface
     */
    public function __invoke($pilotId, $loginToken, $routeId) {
        $this->getParams['pilot_id'] = $pilotId;
        $this->getParams['token'] = $loginToken;
        $this->getParams['route_id'] = $routeId;
        return $this->invokeMe();
    }
}
