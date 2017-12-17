<?php 

namespace App\Bot\Facebook\States\Filters\Postbacks\GetStarted\Handlers;

use \Botomatic\Engine\Facebook\Entities\Response;

/**
 * Class Responses
 * @package  App\Bot\Facebook\States\Filters\Postbacks\GetStarted\Handlers
 */
class Responses extends \Botomatic\Engine\Facebook\Abstracts\States\Response\Handler
{
  /**
   * @return  \Botomatic\Engine\Facebook\Entities\Response
   */
  public function responseDefault() : Response
  {
      return $this->response->addMessage('This is the default message')
        ->setStatusActive()
        ->sendResponse();
  }
}
