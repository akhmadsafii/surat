<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateLetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('template_letters')->insert([
            [
                'initial' => 'head1',
                'name' => 'Head 1',
                'status_skl' => 0,
                'status_skp' => 0,
                'status' => 1,
            ],
            [
                'initial' => 'head2',
                'name' => 'Head 2',
                'status_skl' => 0,
                'status_skp' => 0,
                'status' => 1,
            ],
            [
                'initial' => 'head3',
                'name' => 'Head 3',
                'status_skl' => 0,
                'status_skp' => 0,
                'status' => 1,
            ],
            [
                'initial' => 'alamat',
                'name' => 'Alamat Sekolah',
                'status_skl' => 0,
                'status_skp' => 0,
                'status' => 1,
            ],
            [
                'initial' => 'logo1',
                'name' => 'Logo 1',
                'status_skl' => 0,
                'status_skp' => 0,
                'status' => 1,
            ],
            [
                'initial' => 'logo2',
                'name' => 'Logo 2',
                'status_skl' => 0,
                'status_skp' => 0,
                'status' => 1,
            ],
            [
                'initial' => 'prolog',
                'name' => 'Prolog',
                'status_skl' => 0,
                'status_skp' => 0,
                'status' => 1,
            ],
            [
                'initial' => 'penutup',
                'name' => 'Penutup',
                'status_skl' => 0,
                'status_skp' => 0,
                'status' => 1,
            ],
            [
                'initial' => 'ttd_kepsek',
                'name' => 'TTD Kepsek',
                'status_skl' => 0,
                'status_skp' => 0,
                'status' => 1,
            ],
            [
                'initial' => 'nama_kepsek',
                'name' => 'Nama Kepsek',
                'status_skl' => 0,
                'status_skp' => 0,
                'status' => 1,
            ],
            [
                'initial' => 'stempel',
                'name' => 'Stempel',
                'status_skl' => 0,
                'status_skp' => 0,
                'status' => 1,
            ],
            [
                'initial' => 'nip_kepsek',
                'name' => 'NIP Kepsek',
                'status_skl' => 0,
                'status_skp' => 0,
                'status' => 1,
            ],
            [
                'initial' => 'tempat_keputusan',
                'name' => 'Tempat Keputusan',
                'status_skl' => 0,
                'status_skp' => 0,
                'status' => 1,
            ],
            [
                'initial' => 'tgl_keputusan',
                'name' => 'Tanggal Keputusan',
                'status_skl' => 0,
                'status_skp' => 0,
                'status' => 1,
            ],
            [
                'initial' => 'tahun_ajaran',
                'name' => 'Tahun Ajaran',
                'status_skl' => 0,
                'status_skp' => 0,
                'status' => 1,
            ],

        ]);
    }
}
