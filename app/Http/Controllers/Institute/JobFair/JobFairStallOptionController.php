<?php

namespace App\Http\Controllers\Institute\JobFair;

use App\Http\Controllers\Controller;
use App\Models\JobFairStallOption;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobFairStallOptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:institute');
    }

    public function list():View
    {
        return view('institute.setup.stall_option.index');
    }
}
