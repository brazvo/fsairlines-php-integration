<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetBookStatus extends AbstractOperation
{
    protected $function = 'getBookStatus';

    /**
     * @return ResponseInterface
     */
    public function __invoke($pilotId) {
        $this->getParams['pilot_id'] = $pilotId;
        return $this->invokeMe();
    }
}
