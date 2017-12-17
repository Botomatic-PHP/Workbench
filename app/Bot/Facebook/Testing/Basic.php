<?php

namespace App\Bot\Facebook\Testing;

use \Botomatic\Engine\Platforms\Facebook\Testing\Response;


class Basic extends \Botomatic\Engine\Facebook\Console\Testing\Base
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facebook:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /*--------------------------------------------------------------------------------------------------------------
         *
         * Create a new Test user, if exists it's replaced.
         *
         * This tests the Bot from the perspective of a new user.
         *
         -------------------------------------------------------------------------------------------------------------*/
        $this->newUser();

        /*--------------------------------------------------------------------------------------------------------------
         *
         * Because it's a new user the Listener picks up
         *
         --------------------------------------------------------------------------------------------------------------*/
        $this->sendMessage('hi', function (Response $response)
        {
            return $response
                ->hasMessage('Hello!');
        });
    }
}
