<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetPilotID extends AbstractOperation
{
    protected $function = 'getPilotID';

    /**
     * @return ResponseInterface
     */
    public function __invoke(
        $username,
        $token
    ) {
        $this->getParams['user'] = $username;
        $this->getParams['token'] = $token;
        return $this->invokeMe();
    }
}
