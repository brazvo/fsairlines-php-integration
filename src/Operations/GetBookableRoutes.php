<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetBookableRoutes extends AbstractOperation
{
    protected $function = 'getBookableRoutes';

    /**
     * @return ResponseInterface
     */
    public function __invoke($pilotId, $loginToken) {
        $this->getParams['pilot_id'] = $pilotId;
        $this->getParams['token'] = $loginToken;
        return $this->invokeMe();
    }
}
