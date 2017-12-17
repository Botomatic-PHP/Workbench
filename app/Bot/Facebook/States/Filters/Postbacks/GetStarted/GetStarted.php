<?php 

namespace App\Bot\Facebook\States\Filters\Postbacks\GetStarted;

use \Botomatic\Engine\Facebook\Entities\Response;

/**
 * Class GetStarted
 * @package  App\Bot\Facebook\States\Filters\Postbacks\GetStarted
 */
class GetStarted extends \Botomatic\Engine\Facebook\Abstracts\States\Filter
{
    /**
     * @var  \App\Bot\Facebook\States\Filters\Postbacks\GetStarted\Handlers\Responses
     */
    protected $response;

    /**
     * @var  \App\Bot\Facebook\States\Filters\Postbacks\GetStarted\Handlers\Message
     */
    protected $message;

    /**
     * Logic specific to the state
     *
     * @return  \Botomatic\Engine\Facebook\Entities\Response
     */
    protected function process() : Response
    {
        if ($this->message->isGetStarted())
        {
            // add your logic here
        }

        return $this->response->response();
    }

}