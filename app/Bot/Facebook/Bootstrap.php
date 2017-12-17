<?php

namespace App\Bot\Facebook;

/**
 * Class Bootstrap
 * @package App\Bot\Facebook
 */
class Bootstrap
{
    /**
     * @var \Botomatic\Engine\Core\Entities\Session
     */
    protected $session;

    /**
     * Bootstrap constructor.
     *
     * @param \Botomatic\Engine\Core\Entities\Session $session
     */
    public function __construct(\Botomatic\Engine\Core\Entities\Session $session)
    {
        $this->session = $session;

        $this->resolveLocalisation();
    }

    /**
     * Localisation driver is set in .env file, the default locale is the user's Facebook locale, to overwrite
     * this update code below
     */
    protected function resolveLocalisation()
    {
        \Botomatic\Engine\Facebook\Localization\Localizator\Factory::build($this->session->getUser()->getLocale());
    }
}