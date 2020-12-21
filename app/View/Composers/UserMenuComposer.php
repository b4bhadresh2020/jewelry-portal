<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\UserMenu;

class UserMenuComposer
{

    public function compose(View $view)
    {
        $view->with('userMenus', UserMenu::with('media', 'submenu')->where('parent', 0)->get());
    }
}
