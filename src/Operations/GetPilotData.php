<?php

namespace FSAirlinesPhpIntegration\Operations;

class GetPilotData extends AbstractOperation
{
    protected $function = 'getPilotData';

    public function __invoke($pilotId)
    {
        $this->getParams['pilot_id'] = $pilotId;
        return $this->invokeMe();
    }
}
