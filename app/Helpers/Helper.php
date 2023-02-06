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

    public static function job_array()
    {
        $jobs = [
            'kepsek' => 'Kepala Sekolah',
            'kabag_tu' => 'Kepala Bagian TU',
            'waka_sarpras' => 'WAKA Sarpras',
            'waka_kesiswaan' => 'WAKA Kesiswaan',
            'waka_kurikulum' => 'WAKA Kurikulum',
            'waka_humas' => 'WAKA HUMAS',
            'bk' => 'Koordinator BK',
        ];
        return $jobs;
    }

    public static function get_job($param)
    {
        switch ($param) {
            case 'kepsek':
                return 'Kepala Sekolah';
                break;
            case 'kabag_tu':
                return 'Kepala Bagian TU';
                break;
            case 'waka_sarpras':
                return 'WAKA Sarpras';
                break;
            case 'waka_kesiswaan':
                return 'WAKA Kesiswaan';
                break;
            case 'waka_kurikulum':
                return 'WAKA Kurikulum';
                break;
            case 'waka_humas':
                return 'WAKA HUMAS';
                break;
            case 'bk':
                return 'Koordinator BK';
                break;
            default:
                return 'Error';
                break;
        }
    }
}
