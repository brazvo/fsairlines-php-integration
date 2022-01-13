<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetPosTransactionSums extends AbstractOperation
{
    protected $function = 'getPosTransactionSums';

    /**
     * @return ResponseInterface
     */
    public function __invoke() {
        return $this->invokeMe();
    }
}
