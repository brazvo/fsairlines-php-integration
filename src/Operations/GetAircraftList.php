<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetAircraftList extends AbstractOperation
{
    protected $function = 'getAircraftList';

    /**
     * @return ResponseInterface
     */
    public function __invoke() {
        return $this->invokeMe();
    }
}
