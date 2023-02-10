<?php

namespace App\Helpers;

use Vinkla\Hashids\Facades\Hashids;

class Helper
{
    public static function encode($param)
    {
        $value = Hashids::encode($param);
        return $value;
    }

    public static function str_random($length)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

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

    public static function ttd_array()
    {
        $jobs = [
            'kepsek' => 'Kepala Sekolah',
            'sekretaris' => 'Sekretaris Sekolah',
            'waka' => 'WAKA Sekolah'
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

    public static function getInital($param)
    {
        $acronym = preg_split("/[\s,_-]+/", $param);
        $result = "";

        foreach ($acronym as $w) {
            $result .= mb_substr($w, 0, 1);
        }
        return strtoupper($result);
    }

    public static function getRomawi($param)
    {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($param > 0) {
            foreach ($map as $roman => $int) {
                if ($param >= $int) {
                    $param -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}
