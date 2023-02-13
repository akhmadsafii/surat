<?php

namespace App\Helpers;

class StatusHelper
{
    public static function messages($status)
    {
        switch ($status) {
            case 1:
                return [
                    'message' => 'Dibaca',
                    'class' => 'success',
                ];
                break;
            case 2:
                return [
                    'message' => 'Belum dibaca',
                    'class' => 'info',
                ];
                break;
            case 3:
                return [
                    'message' => 'Konfirmasi',
                    'class' => 'danger',
                ];
                break;
            case 4:
                return [
                    'message' => 'Draft',
                    'class' => 'warning',
                ];
                break;
            default:
                return [
                    'message' => 'Tidak diketahui',
                    'class' => 'warning',
                ];
                break;
        }
    }

    public static function dispositions($status)
    {
        switch ($status) {
            case 1:
                return [
                    'message' => 'Dibaca',
                    'class' => 'success',
                ];
                break;
            case 2:
                return [
                    'message' => 'Belum dibaca',
                    'class' => 'warning',
                ];
                break;
            case 3:
                return [
                    'message' => 'Diteruskan',
                    'class' => 'accent',
                ];
                break;
            default:
                return [
                    'message' => 'Tidak diketahui',
                    'class' => 'warning',
                ];
                break;
        }
    }
}
