<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use \Carbon\Carbon;
use App\Utama;
use App\Detil;

class PoiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('info_utama')->delete();
    	foreach (range(1,10) as $index) {
	        Utama::insert([
	            'lokasi' => $faker->streetName,
	            'latitude' => $faker->latitude(),
	            'longitude' => $faker->longitude(),
	            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
	            'last_updated_by' => $faker->name,
	        ]);
        }

        DB::table('info_detail')->delete();
        foreach (range(1,10) as $index2) {
           Detil::insert([
                'keterangan' => $faker->realText($maxNbChars = 1000, $indexSize = 2),
                'image' => $faker->imageUrl($width = 640, $height = 280),
                'image2' => $faker->imageUrl($width = 640, $height = 280),
                'image3' => $faker->imageUrl($width = 640, $height = 280),
                'image4' => $faker->imageUrl($width = 640, $height = 280),
                'image5' => $faker->imageUrl($width = 640, $height = 280),
                'image6' => $faker->imageUrl($width = 640, $height = 280),
                'image7' => $faker->imageUrl($width = 640, $height = 280),
                'image8' => $faker->imageUrl($width = 640, $height = 280),
                'image9' => $faker->imageUrl($width = 640, $height = 280),
                'image10' => $faker->imageUrl($width = 640, $height = 280),
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'last_created_by' => $faker->name,
            ]);
        }

         DB::table('pengguna')->delete();
         foreach (range(1,10) as $index3) {
         DB::table('pengguna')->insert([
            'peng'=>$faker->name,
            'usrn'=>$faker->userName,
            'roles'=>$faker->randomElement(['admin','user']),
            'email'=>$faker->email,
            'pwd' => $faker->password,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        
     }
    }
}
