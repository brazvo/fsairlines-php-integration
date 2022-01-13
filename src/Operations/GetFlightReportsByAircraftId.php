<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetFlightReportsByAircraftId extends AbstractOperation
{
    protected $function = 'getFlightReports';

    /**
     * @return ResponseInterface
     */
    public function __invoke(
        $acId,
        $days = null,
        $count = null
    ) {
        if ($acId) $this->getParams['ac_id'] = $acId;
        if ($days) $this->getParams['days'] = $days;
        if ($count) $this->getParams['count'] = $count;

        return $this->invokeMe();
    }
}
