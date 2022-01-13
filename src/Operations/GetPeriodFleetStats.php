<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetPeriodFleetStats extends AbstractOperation
{
    protected $function = 'getPeriodFleetStats';

    /**
     * @return ResponseInterface
     */
    public function __invoke($fromTimestamp, $toTimestamp) {
        $this->getParams['from_ts'] = $fromTimestamp;
        $this->getParams['to_ts'] = $toTimestamp;
        return $this->invokeMe();
    }
}
