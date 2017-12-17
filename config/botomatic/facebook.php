<?php

use \App\Bot\Facebook\States\Filters\Postbacks\Menu\BusinessModel\Payloads as MenuPayloads;

return [

    /*------------------------------------------------------------------------------------------------------------------
     *
     * The bot can be hooked to multiple pages, define each page_id => page_access_token here.
     * It is recommended that you store this in the .env file
     *
     ------------------------------------------------------------------------------------------------------------------*/
    'pages' => [
        '12345678' => 'longappaccesstoken'
    ],

    /*------------------------------------------------------------------------------------------------------------------
     *
     * Messenger Profile is the central store for your bot's properties.
     *
     *
     * https://developers.facebook.com/docs/messenger-platform/messenger-profile
     ------------------------------------------------------------------------------------------------------------------*/
    'profile' => [

        /*
         * Locale-aware greeting for users coming into your bot for the first time.
         * This can be used to communicate your bot's functionality.
         *
         * https://developers.facebook.com/docs/messenger-platform/messenger-profile/greeting-text
         */
        'greeting_text' => [
            [
                'locale' => 'default',
                'text' => 'Servus {{user_full_name}}',
            ]
        ],

        /*
         * A bot's welcome screen can display a Get Started button.
         *
         * When this button is tapped, we will trigger the postback received webhook and
         * deliver the user's page-scoped ID (PSID).
         *
         * https://developers.facebook.com/docs/messenger-platform/messenger-profile/get-started-button
         *
         * App\Bot\Facebook\States\Filters\Postbacks\GetStarted Postback is already responding to this payload
         */
        'get_started_button' => 'payload_get_started',

        /*
         * https://developers.facebook.com/docs/messenger-platform/messenger-profile/persistent-menu
         */
        'persistent_menu' => [
            [
                'locale' => 'default',
                'composer_input_disabled' => false,
                'call_to_actions' => [
                    [
                        'title' => 'ℹ️ Example',
                        'type' => 'postback',
                        'payload' => MenuPayloads::PAYLOAD_EXAMPLE
                    ],
                    [
                        'title' => '🔃 Reset',
                        'type' => 'postback',
                        'payload' => MenuPayloads::PAYLOAD_RESET
                    ],
                    [
                        'title' => '🤖 Powered by Botomatic',
                        'type' => 'web_url',
                        'url' => 'http://botomatic.io'
                    ]
                ]
            ],
        ]

    ],

    /*------------------------------------------------------------------------------------------------------------------
     *
     * Object instantiated in Engine's construct.
     *
     ------------------------------------------------------------------------------------------------------------------*/
    'bootstrap' => \App\Bot\Facebook\Bootstrap::class,

    /*------------------------------------------------------------------------------------------------------------------
     *
     * Contains all the conversations used by Array driver
     *
     ------------------------------------------------------------------------------------------------------------------*/
    'conversations' => 'Bot/Facebook/Resources/Conversations.php',
];