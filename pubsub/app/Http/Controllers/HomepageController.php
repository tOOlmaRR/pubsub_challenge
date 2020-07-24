<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomepageController extends Controller
{
    /**
     *  @return View
     */
    public function view() : View
    {
        return view('welcome');
    }
}
