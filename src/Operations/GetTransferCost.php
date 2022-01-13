<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetTransferCost extends AbstractOperation
{
    protected $function = 'getTransferCost';

    /**
     * @return ResponseInterface
     */
    public function __invoke($departure, $arrival) {
        $this->getParams['dep'] = $departure;
        $this->getParams['arr'] = $arrival;
        return $this->invokeMe();
    }
}
