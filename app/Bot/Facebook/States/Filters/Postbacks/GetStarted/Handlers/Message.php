<?php 

namespace App\Bot\Facebook\States\Filters\Postbacks\GetStarted\Handlers;

/**
 * Class Message
 * @package  App\Bot\Facebook\States\Filters\Postbacks\GetStarted\Handlers
 */
class Message extends \Botomatic\Engine\Facebook\Abstracts\States\Message\Handler
{
    /**
     * @return bool
     */
    public function isGetStarted() : bool
    {
        return $this->message()->postback()->getPayload() == 'payload_get_started';
    }

}
