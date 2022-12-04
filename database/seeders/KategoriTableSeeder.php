<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('categories')->insertGetId(['kategori_adi' => 'elektronik', 'slug' => 'elektronik']);

            DB::table('categories')->insert(['kategori_adi' => 'Bilgisayar', 'slug' => 'bilgisayar',
                'ust_id' => $id]);
            DB::table('categories')->insert(['kategori_adi' => 'Telefon', 'slug' => 'telefon',
                'ust_id' => $id]);
            DB::table('categories')->insert(['kategori_adi' => 'Diğer', 'slug' => 'diger',
                'ust_id' => $id]);

        $id = DB::table('categories')->insertGetId(['kategori_adi' => 'giyim', 'slug' => 'giyim']);

            DB::table('categories')->insert(['kategori_adi' => 'Erkek', 'slug' => 'erkek',
                'ust_id' => $id]);
            DB::table('categories')->insert(['kategori_adi' => 'Kadın', 'slug' => 'kadin',
                'ust_id' => $id]);
            DB::table('categories')->insert(['kategori_adi' => 'Çocuk', 'slug' => 'cocuk',
                'ust_id' => $id]);

        $id = DB::table('categories')->insertGetId(['kategori_adi' => 'mobilya', 'slug' => 'mobilya']);

            DB::table('categories')->insert(['kategori_adi' => 'Oturma Odası', 'slug' => 'OturmaOdasi',
                'ust_id' => $id]);
            DB::table('categories')->insert(['kategori_adi' => 'Çalışma Odası', 'slug' => 'CalismaOdasi',
                'ust_id' => $id]);
            DB::table('categories')->insert(['kategori_adi' => 'Yatak Odası', 'slug' => 'YatakOdasi',
                'ust_id' => $id]);

    }
}
