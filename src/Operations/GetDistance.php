<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetDistance extends AbstractOperation
{
    protected $function = 'getDistance';

    /**
     * @return ResponseInterface
     */
    public function __invoke($icaoFrom, $icaoTo) {
        $this->getParams['icao_from'] = $icaoFrom;
        $this->getParams['icao_to'] = $icaoTo;
        return $this->invokeMe();
    }
}
