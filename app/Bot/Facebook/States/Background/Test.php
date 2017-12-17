<?php

namespace App\Bot\Facebook\States\Background;

/**
 * Class Test
 * @package App\Bot\Facebook\States\Background
 */
class Test extends \Botomatic\Engine\Facebook\Console\Abstracts\Background
{

    protected $signature = 'facebook:background';

    /**
     * @param \Botomatic\Engine\Facebook\Entities\Scope $scope
     *
     * @return \Botomatic\Engine\Facebook\Entities\Response|\Botomatic\Engine\Facebook\Abstracts\States\Workflow|null
     */
    protected function process(\Botomatic\Engine\Facebook\Entities\Scope $scope)
    {
        /**
         * Response that is dispatched to facebook
         */
        return $this->respond()->addMessage('Hey!');

        /**
         * Response that moves the scope to a new state
         */
//        return $this->jumpToState();
    }
}