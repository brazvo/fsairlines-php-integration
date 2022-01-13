<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetFlightReports extends AbstractOperation
{
    protected $function = 'getFlightReports';

    /**
     * @return ResponseInterface
     */
    public function __invoke(
        $days = null,
        $count = null
    ) {
        if ($days) $this->getParams['days'] = $days;
        if ($count) $this->getParams['count'] = $count;

        return $this->invokeMe();
    }
}
