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
            $this->setEnvironmentValue('APP_LOCALE', $locale);
            auth()->user()->locale = $locale;
            auth()->user()->save();
        }
        session()->save();
        for ($i = 0; $i < 20; $i++) {
            echo ('');
        }
        try {
            return redirect()->back();
        } catch (Exception $e) {
            $url = "/home";
            return Redirect::to($url);
        }
    }

    public function setEnvironmentValue($envKey, $envValue): void
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $oldValue = env('APP_LOCALE');

        $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}", $str);

        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }
}
