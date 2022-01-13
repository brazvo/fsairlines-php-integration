<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class GetRouteData extends AbstractOperation
{
    protected $function = 'getRouteData';

    /**
     * @return ResponseInterface
     */
    public function __invoke($routeId) {
        $this->getParams['route_id'] = $routeId;
        return $this->invokeMe();
    }
}
