<?php 

namespace App\Bot\Facebook\States\Filters\General\Keywords\Handlers;

/**
 * Class Message
 * @package  App\Bot\Facebook\States\Filters\General\Keywords\Handlers
 */
class Message extends \Botomatic\Engine\Facebook\Abstracts\States\Message\Handler
{
    /**
     * @return bool
     */
    public function saysBotomatic() : bool
    {
        return $this->message()->getMessage() == 'botomatic';
    }
}
