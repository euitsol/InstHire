<?php

namespace App\Http\Controllers\Institute;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function update(Request $request)
    {
        $theme = $request->input('theme');
        
        if (in_array($theme, ['light', 'dark'])) {
            session(['theme' => $theme]);
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 400);
    }
}
