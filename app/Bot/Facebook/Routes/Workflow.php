<?php

use App\Bot\Facebook\States\Listener\Listener;
use Botomatic\Engine\Facebook\Entities\Response;

return [
    /*--------------------------------------------------------------------------------------------------------------
     *
     *
     * Listener
     *
     *
     -------------------------------------------------------------------------------------------------------------*/
    Listener::class => [
        Response::STATUS_FINISH => null,
    ],

];