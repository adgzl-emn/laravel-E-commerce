<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\ProductsDetail;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();

        $fake_urun = $faker->sentence(2);


        for ($i = 1; $i<31; $i++)
        {
            $fake_urun = $faker->sentence(2);
            DB::table("products")->insert([
                "product_name" => $fake_urun,
                "slug" => Str::slug($fake_urun),
                "aciklama" => $faker->sentence(5),
                "fiyat" => $faker->randomFloat(2,1,2000)

            ]);


            DB::table("product_details")->insert([
                'products_id' => $i,
                'images' => 'uploads/null.png',
                'goster_slider' => rand(0,1),
                'goster_gunun_firsati' => rand(0,1),
                'goster_one_cikan' => rand(0,1),
                'goster_cok_satan' => rand(0,1),
                'goster_indirimli' => rand(0,1),
            ]);



        }


     /*
        DB::table("students")->insert([
            "name" => $faker->name(),
            "email" => $faker->safeEmail,
            "mobile" => $faker->phoneNumber,
            "age" => $faker->numberBetween(25, 50),
            "gender" => $faker->randomElement(["male", "female", "others"]),
            "address_info" => $faker->address,
        ]);
       */
    }
}
