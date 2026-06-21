<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ParametreController extends Controller
{
    public function index()
    {
        return view('admin.parametres.index');
    }
}
