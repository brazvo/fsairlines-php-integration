<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetFlightReportsByPilotId extends AbstractOperation
{
    protected $function = 'getFlightReports';

    /**
     * @return ResponseInterface
     */
    public function __invoke(
        $pilotId = null,
        $days = null,
        $count = null
    ) {
        if ($pilotId) $this->getParams['pilot_id'] = $pilotId;
        if ($days) $this->getParams['days'] = $days;
        if ($count) $this->getParams['count'] = $count;

        return $this->invokeMe();
    }
}
