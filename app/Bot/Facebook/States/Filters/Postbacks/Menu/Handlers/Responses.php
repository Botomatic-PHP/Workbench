<?php 

namespace App\Bot\Facebook\States\Filters\Postbacks\Menu\Handlers;

/**
 * Class Responses
 * @package  App\Bot\Facebook\States\Filters\Postbacks\Menu\Handlers
 */
class Responses extends \Botomatic\Engine\Facebook\Abstracts\States\Response\Handler
{
    /**
     * @return  \Botomatic\Engine\Facebook\Entities\Response
     */
    public function example() : \Botomatic\Engine\Facebook\Entities\Response
    {
      return $this->response->addMessage('Postback captured')
          ->sendResponse();
    }

}
