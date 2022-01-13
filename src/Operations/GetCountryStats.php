<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetCountryStats extends AbstractOperation
{
    protected $function = 'getCountryStats';

    /**
     * @return ResponseInterface
     */
    public function __invoke($country) {
        $this->getParams['country'] = $country;
        return $this->invokeMe();
    }
}
