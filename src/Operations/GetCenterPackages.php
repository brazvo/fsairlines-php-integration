<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetCenterPackages extends AbstractOperation
{
    protected $function = 'getCenterPackages';

    /**
     * @return ResponseInterface
     */
    public function __invoke($centerId) {
        $this->getParams['center_id'] = $centerId;
        return $this->invokeMe();
    }
}
