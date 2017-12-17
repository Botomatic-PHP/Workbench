<?php 

namespace App\Bot\Facebook\States\Filters\General\Keywords;

use \Botomatic\Engine\Facebook\Entities\Response;

/**
 * Class Keywords
 * @package  App\Bot\Facebook\States\Filters\General\Keywords
 */
class Keywords extends \Botomatic\Engine\Facebook\Abstracts\States\Filter
{
    /**
     * @var  \App\Bot\Facebook\States\Filters\General\Keywords\Handlers\Responses
     */
    protected $response;

    /**
     * @var  \App\Bot\Facebook\States\Filters\General\Keywords\Handlers\Message
     */
    protected $message;

    /**
     * Logic specific to the state
     *
     * @return  \Botomatic\Engine\Facebook\Entities\Response
     */
    protected function process(): Response
    {
        if ($this->message->saysBotomatic())
        {
            return $this->response->responseDefault();
        }

        // Continue flow normally
        return $this->response->response();
    }
}