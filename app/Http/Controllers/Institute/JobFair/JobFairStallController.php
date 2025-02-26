<?php

namespace App\Http\Controllers\Institute\JobFair;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobFairStallController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:institute');
    }
}
