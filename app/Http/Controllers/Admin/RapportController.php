<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class RapportController extends Controller
{
    public function index()
    {
        return view('admin.rapports.index');
    }
}
