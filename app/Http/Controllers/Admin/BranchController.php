<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BranchController extends Controller
{
    public function index()
    {
        return view('admin.branch');
    }
}