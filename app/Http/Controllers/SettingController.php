<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        session()->put('title', 'Konfigurasi Aplikasi');
        $setting = $this->data_env();
        // dd($setting);
        return view('content.settings.v_setting', compact('setting'));
    }

    public function store(Request $request)
    {
        $setting = $this->data_env();
        $data = [
            'logo' => $setting['logo']
        ];
        if (!empty($request->logo)) {
            $data = ImageHelper::upload_asset($request, 'logo', 'upload/setting', $data);
        }
        // dd($data);
        Helper::env_update('CONFIG_NAME_SCHOOL="' . $setting['name_school'] . '"', 'CONFIG_NAME_SCHOOL="' . $request->name_school . '"');
        Helper::env_update('CONFIG_NAME_APPLICATION="' . $setting['name_application'] . '"', 'CONFIG_NAME_APPLICATION="' . $request->name_application . '"');
        Helper::env_update('CONFIG_NPSN="' . $setting['npsn'] . '"', 'CONFIG_NPSN="' . $request->npsn . '"');
        Helper::env_update('CONFIG_PHONE="' . $setting['phone'] . '"', 'CONFIG_PHONE="' . $request->phone . '"');
        Helper::env_update('CONFIG_EMAIL="' . $setting['email'] . '"', 'CONFIG_EMAIL="' . $request->email . '"');
        Helper::env_update('CONFIG_WEBSITE="' . $setting['website'] . '"', 'CONFIG_WEBSITE="' . $request->website . '"');
        Helper::env_update('CONFIG_MAX_UPLOAD="' . $setting['max_upload'] . '"', 'CONFIG_MAX_UPLOAD="' . $request->max_upload . '"');
        Helper::env_update('CONFIG_SIZE_COMPRESS="' . $setting['size_compress'] . '"', 'CONFIG_SIZE_COMPRESS="' . $request->size_compress . '"');
        Helper::env_update('CONFIG_ADDRESS="' . $setting['address'] . '"', 'CONFIG_ADDRESS="' . $request->address . '"');
        Helper::env_update('CONFIG_FOOTER="' . $setting['footer'] . '"', 'CONFIG_FOOTER="' . $request->footer . '"');
        Helper::env_update('CONFIG_LOGO="' . $setting['logo'] . '"', 'CONFIG_LOGO="' . $data['logo'] . '"');
        Helper::env_update('CONFIG_FORMAT_IMAGE="' . $setting['format_image'] . '"', 'CONFIG_FORMAT_IMAGE="' . str_replace(',', '|', $request->format_image) . '"');
    }

    public function reset()
    {
        $setting = $this->data_env();
        Helper::env_update('CONFIG_NAME_SCHOOL="' . $setting['name_school'] . '"', 'CONFIG_NAME_SCHOOL=""');
        Helper::env_update('CONFIG_NAME_APPLICATION="' . $setting['name_application'] . '"', 'CONFIG_NAME_APPLICATION=""');
        Helper::env_update('CONFIG_NPSN="' . $setting['npsn'] . '"', 'CONFIG_NPSN=""');
        Helper::env_update('CONFIG_PHONE="' . $setting['phone'] . '"', 'CONFIG_PHONE=""');
        Helper::env_update('CONFIG_EMAIL="' . $setting['email'] . '"', 'CONFIG_EMAIL=""');
        Helper::env_update('CONFIG_WEBSITE="' . $setting['website'] . '"', 'CONFIG_WEBSITE=""');
        Helper::env_update('CONFIG_MAX_UPLOAD="' . $setting['max_upload'] . '"', 'CONFIG_MAX_UPLOAD=""');
        Helper::env_update('CONFIG_SIZE_COMPRESS="' . $setting['size_compress'] . '"', 'CONFIG_SIZE_COMPRESS=""');
        Helper::env_update('CONFIG_ADDRESS="' . $setting['address'] . '"', 'CONFIG_ADDRESS=""');
        Helper::env_update('CONFIG_FOOTER="' . $setting['footer'] . '"', 'CONFIG_FOOTER=""');
        Helper::env_update('CONFIG_LOGO="' . $setting['logo'] . '"', 'CONFIG_LOGO=""');
        Helper::env_update('CONFIG_FORMAT_IMAGE="' . $setting['format_image'] . '"', 'CONFIG_FORMAT_IMAGE=""');
    }

    function data_env()
    {
        $setting = [
            'name_school' => env('CONFIG_NAME_SCHOOL'),
            'name_application' => env('CONFIG_NAME_APPLICATION'),
            'npsn' => env('CONFIG_NPSN'),
            'phone' => env('CONFIG_PHONE'),
            'email' => env('CONFIG_EMAIL'),
            'website' => env('CONFIG_WEBSITE'),
            'max_upload' => env('CONFIG_MAX_UPLOAD'),
            'size_compress' => env('CONFIG_SIZE_COMPRESS'),
            'format_image' => env('CONFIG_FORMAT_IMAGE'),
            'address' => env('CONFIG_ADDRESS'),
            'footer' => env('CONFIG_FOOTER'),
            'logo' => env('CONFIG_LOGO'),
        ];
        return $setting;
    }
}
