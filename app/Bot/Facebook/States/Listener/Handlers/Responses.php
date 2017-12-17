<?php

namespace App\Bot\Facebook\States\Listener\Handlers;

use \Botomatic\Engine\Facebook\Entities\Response;

/**
 * Class Responses
 * @package App\Bot\Facebook\States\Listener\Handlers
 */
class Responses extends \Botomatic\Engine\Facebook\Abstracts\States\Response\Handler
{
    /**
     * @param string $name
     *
     * @return \Botomatic\Engine\Facebook\Entities\Response
     */
    public function responseDefault(string $name) : Response
    {
        return $this->response->addMessage('hello ' . $name)
            ->sendResponse()
            ->setStatusActive();
    }

    /**
     * @return \Botomatic\Engine\Facebook\Entities\Response
     */
    public function options() : Response
    {
        return $this->response->addMessage('Can\'t understand that.... say hi')
            ->sendResponse()
            ->setStatusActive();
    }
}
