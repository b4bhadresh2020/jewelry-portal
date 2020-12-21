<?php

namespace App\View\Composers;

use App\Helpers\Helper;
use Illuminate\View\View;

class LanguageComposer
{

    public function compose(View $view)
    {
        $configData = Helper::applClasses();
        $locale = $configData['defaultLanguage'];
        if (session()->has('locale')) {
            $locale = session()->get('locale');
        }

        $view->with([
            'findLanguage'       => findLanguage(),
            'findActiveLanguage' => findActiveLanguage(),
            'findFrontLanguage'  => findFrontLanguage(),
            'locale'             => $locale
        ]);
    }
}
