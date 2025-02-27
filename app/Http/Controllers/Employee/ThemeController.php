<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function update(Request $request)
    {
        $theme = $request->theme;
        session(['theme' => $theme]);
        return response()->json(['success' => true]);
    }
}
