<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetFleetStats extends AbstractOperation
{
    protected $function = 'getFleetStats';

    /**
     * @return ResponseInterface
     */
    public function __invoke() {
        return $this->invokeMe();
    }
}
