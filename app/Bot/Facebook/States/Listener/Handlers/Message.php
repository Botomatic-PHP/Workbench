<?php

namespace App\Bot\Facebook\States\Listener\Handlers;

/**
 * Class Message
 * @package App\Bot\Facebook\States\Listener\Handlers
 */
class Message extends \Botomatic\Engine\Facebook\Abstracts\States\Message\Handler
{
    /*
     * Traits
     */
    use \Botomatic\Engine\Facebook\Abstracts\States\Message\Traits\Normalize;

    /**
     * @return bool
     */
    public function saysHi(): bool
    {
        return $this->normalizeMessage() == 'hi';
    }
}
