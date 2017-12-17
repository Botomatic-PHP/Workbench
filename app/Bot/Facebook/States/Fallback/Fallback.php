<?php 

namespace App\Bot\Facebook\States\Fallback;

use \Botomatic\Engine\Facebook\Entities\Response;

/**
 * Class Fallback
 * @package  App\Bot\Facebook\States\Fallback
 */
class Fallback extends \Botomatic\Engine\Facebook\Abstracts\States\Workflow
{

    /**
     * @var  \App\Bot\Facebook\States\Fallback\Handlers\Responses
     */
    protected $response;

    /**
     * @var  \App\Bot\Facebook\States\Fallback\Handlers\Message
     */
    protected $message;

    /**
     * Logic specific to the state
     *
     * @return  \Botomatic\Engine\Facebook\Entities\Response
     */
    protected function process() : Response
    {
        return $this->response->responseDefault();
    }
}