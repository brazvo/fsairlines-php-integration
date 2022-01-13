<?php

namespace FSAirlinesPhpIntegration\Operations;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

class PilotLogin extends AbstractOperation
{
    protected $function = 'pilotLogin';

    /**
     * @return ResponseInterface
     */
    public function __invoke($username, $password) {
        $post = [
            'user' => $username,
            'password' => $password
        ];

        return $this->post($post);
    }
}
