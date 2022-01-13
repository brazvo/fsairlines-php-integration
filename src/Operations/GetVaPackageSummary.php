<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetVaPackageSummary extends AbstractOperation
{
    protected $function = 'getVaPackageSummary';

    /**
     * @return ResponseInterface
     */
    public function __invoke() {
        return $this->invokeMe();
    }
}
