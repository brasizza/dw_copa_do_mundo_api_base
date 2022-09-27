<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Country::truncate();


        \App\Models\Country::factory()->create(
            ['country_code' => 'FWC','country_name' => 'Fifa World Cup' , 'index' => 0 , 'stickers_start' => 1 , 'stickers_end' => 18],

        );

        \App\Models\Country::factory()->create(
            ['country_code' => 'QAT','country_name' => 'Quatar', 'index' => 1,],

        );

        \App\Models\Country::factory()->create(
            ['country_code' => 'ECU','country_name' => 'Ecuador', 'index' => 2, ],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'SEN','country_name' => 'Senegal' , 'index' => 3, ],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'NED','country_name' => 'Holanda', 'index' => 4 , ],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'ENG','country_name' => 'Inglaterra', 'index' => 5 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'IRN','country_name' => 'Irã', 'index' => 6 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'USA','country_name' => 'USA', 'index' => 7 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'WAL','country_name' => 'Gales', 'index' => 8 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'ARG','country_name' => 'Argentina', 'index' => 9 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'KSA','country_name' => 'Arábia saudita', 'index' => 10 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'MEX','country_name' => 'México', 'index' =>11 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'POL','country_name' => 'Polônia', 'index' => 12 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'FRA','country_name' => 'França', 'index' => 13 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'AUS','country_name' => 'Austrália', 'index' => 14 , ],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'DEN','country_name' => 'Dinamarca', 'index' => 15 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'TUN','country_name' => 'Tunísia', 'index' => 16 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'ESP','country_name' => 'Espanha', 'index' => 17 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'CRC','country_name' => 'Costa rica', 'index' => 18 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'GER','country_name' => 'Alemanha', 'index' => 19 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'JPN','country_name' => 'Japão', 'index' => 20 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'BEL','country_name' => 'Belgica', 'index' => 21 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'CAN','country_name' => 'Canadá', 'index' => 22,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'MAR','country_name' => 'Marrocos', 'index' => 23 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'CRO','country_name' => 'Croácia', 'index' => 24 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'BRA','country_name' => 'Brasil', 'index' => 25 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'SBR','country_name' => 'Sérvia', 'index' => 26 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'SUI','country_name' => 'Suiça', 'index' => 27 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'CMR','country_name' => 'Camarões', 'index' => 28 ,],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'POR','country_name' => 'Portugal', 'index' => 29 ,],

        );

        \App\Models\Country::factory()->create(
            ['country_code' => 'GHA','country_name' => 'Gana', 'index' => 30 ,],

        );

        \App\Models\Country::factory()->create(
            ['country_code' => 'URU','country_name' => 'Uruguai', 'index' => 31 ,],

        );

        \App\Models\Country::factory()->create(
            ['country_code' => 'KOR','country_name' => 'Korea', 'index' => 32 ,],

        );


        \App\Models\Country::factory()->create(
            ['country_code' => 'FWC','country_name' => 'Fifa World Cup', 'index' => 33 , 'stickers_start' => 19 , 'stickers_end' => 28],

        );

    }
}
