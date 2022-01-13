<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetAirlineData extends AbstractOperation
{
    protected $function = 'getAirlineData';

    /**
     * @return ResponseInterface
     */
    public function __invoke($id) {
        $this->getParams['id'] = $id;
        return $this->invokeMe();
    }
}
