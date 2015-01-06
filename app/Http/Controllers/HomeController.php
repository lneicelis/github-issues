<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Container\Container;
use Illuminate\Session\SessionInterface;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('layout');
    }
}