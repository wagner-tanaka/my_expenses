<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Redirect;

class LocaleController extends Controller
{
    public function locale($locale)
    {
        session(['locale' => $locale]);
        if(auth()->user()){
            auth()->user()->locale = $locale;
            auth()->user()->save();
        }
        session()->save();

        try {
            return redirect()->back();
        } catch (Exception $e) {
            $url = "/home";
            return Redirect::to($url);
        }
    }
}
