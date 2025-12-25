<?php

namespace App\Managers;


use App\Models\Settings;

class SettingsManager
{
    public static function getSettingsValueByKey($key, $value = 0, $as_integer = 0){
        $setting = Settings::where('code_key', $key)->first();
        if($setting instanceof Settings){
            $value = $as_integer ? (int) $setting->value : $setting->value;
        }
        return $value;
    }
}
