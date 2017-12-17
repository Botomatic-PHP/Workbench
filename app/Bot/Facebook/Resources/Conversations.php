<?php

use Botomatic\Engine\Facebook\Localization\Locales as Locale;

return [

    /*
     * All the conversations used by the listener
     */
    'listener' => [

        /*
         * Description is optional and intended to be used when switching to DB storage and handle texts from UI
         */
        'description' => 'All strings used by the listener',

        /*
         * Texts are stored within "translations" node
         */
        'translations' => [

            'hello' => [
                Locale::en_US => 'Hello :name',
                Locale::de_DE => 'Hallo :name',

                /*
                 * Description is optional and intended to be used when switching to DB storage and handle texts from UI
                 */
                'description' => 'says hi'
            ],

            'options' => [
                Locale::en_US => 'Can\'t understand this',
            ],

        ]
    ],
];