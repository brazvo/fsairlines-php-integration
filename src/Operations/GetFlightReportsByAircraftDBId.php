<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetFlightReportsByAircraftDBId extends AbstractOperation
{
    protected $function = 'getFlightReports';

    /**
     * @return ResponseInterface
     */
    public function __invoke(
        $acDbId,
        $days = null,
        $count = null
    ) {
        if ($acDbId) $this->getParams['acdb_id'] = $acDbId;
        if ($days) $this->getParams['days'] = $days;
        if ($count) $this->getParams['count'] = $count;

        return $this->invokeMe();
    }
}
