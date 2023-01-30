<?php

namespace App\Helpers;

class Helper
{
    public static function check_and_make_dir($path)
    {
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }

    public static function env_update($old, $new)
    {
        $path = base_path('.env');
        $content = file_get_contents($path);
        if (file_exists($path)) {
            file_put_contents($path, str_replace($old, $new, $content));
        }
    }
}
