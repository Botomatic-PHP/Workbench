<?php 

namespace App\Bot\Facebook\States\Filters\General\Keywords\Handlers;

use \Botomatic\Engine\Facebook\Entities\Response;

/**
 * Class Responses
 * @package  App\Bot\Facebook\States\Filters\General\Keywords\Handlers
 */
class Responses extends \Botomatic\Engine\Facebook\Abstracts\States\Response\Handler
{

  /**
   * @return  \Botomatic\Engine\Facebook\Entities\Response
   */
  public function responseDefault() : Response
  {
      return $this->response->addMessage('Botomatic is great!')
        ->setStatusActive()
        ->sendResponse();
  }
}
