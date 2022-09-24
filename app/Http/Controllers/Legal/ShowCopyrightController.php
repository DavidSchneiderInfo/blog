<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;

class ShowCopyrightController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return view('legal.doc')
            ->with(
                'doc',
                file_get_contents(lang_path(app()->getLocale().'/legal/copyright.md'))
            );
    }
}
