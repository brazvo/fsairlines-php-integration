<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetReportDetail extends AbstractOperation
{
    protected $function = 'getReportDetail';

    /**
     * @return ResponseInterface
     */
    public function __invoke($reportId) {
        $this->getParams['report_id'] = $reportId;
        return $this->invokeMe();
    }
}
