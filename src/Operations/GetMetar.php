<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetMetar extends AbstractOperation
{
    protected $function = 'getMetar';

    /**
     * @return ResponseInterface
     */
    public function __invoke($icao) {
        $this->getParams['icao'] = $icao;
        return $this->invokeMe();
    }
}
