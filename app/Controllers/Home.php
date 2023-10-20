<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('gallery', [
            "title" => "Gallery"
        ]);
    }

    public function dashboard(): string
    {
        return view('dashboard', [
            "title" => "Dashboard"
        ]);
    }
}
