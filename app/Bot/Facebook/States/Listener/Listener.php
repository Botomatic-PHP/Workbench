<?php

namespace App\Bot\Facebook\States\Listener;

use \Botomatic\Engine\Facebook\Entities\Response;

/**
 * Class Listener
 * @package App\Bot\Facebook\States\Test\Listener
 */
class Listener extends \Botomatic\Engine\Facebook\Abstracts\States\Workflow
{

    /**
     * @var \App\Bot\Facebook\States\Listener\Handlers\Responses
     */
    protected $response;

    /**
     * @var \App\Bot\Facebook\States\Listener\Handlers\Message
     */
    protected $message;

    /**
     * Logic specific to the state
     *
     * @return \Botomatic\Engine\Facebook\Entities\Response
     */
    protected function process() : Response
    {
        if ($this->message->saysHi())
        {
            return $this->response->responseDefault($this->session->getUser()->getName());
        }

        /**
         * Handling the edge cases is extremely important when building a Chatbot
         */
        else
        {
            return $this->response->options();
        }
    }
}