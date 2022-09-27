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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'User teste',
            'email' => 'user@user.com',
            'password' => '123456'
        ]);


        \App\Models\Country::factory()->create(
            ['country_code' => 'FWC','country_name' => 'Fifa World Cup'],

        );

        \App\Models\Country::factory()->create(
            ['country_code' => 'QAT','country_name' => 'Quatar'],

        );

        \App\Models\Country::factory()->create(
            ['country_code' => 'ECU','country_name' => 'Ecuador'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'SEN','country_name' => 'Senegal'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'NED','country_name' => 'Holanda'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'ENG','country_name' => 'Inglaterra'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'IRN','country_name' => 'Irã'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'USA','country_name' => 'USA'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'WAL','country_name' => 'Gales'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'ARG','country_name' => 'Argentina'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'KSA','country_name' => 'Arábia saudita'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'MEX','country_name' => 'México'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'POL','country_name' => 'Polônia'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'FRA','country_name' => 'França'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'AUS','country_name' => 'Austrália'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'DEN','country_name' => 'Dinamarca'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'TUN','country_name' => 'Tunísia'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'ESP','country_name' => 'Espanha'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'CRC','country_name' => 'Costa rica'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'GER','country_name' => 'Alemanha'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'JPN','country_name' => 'Japão'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'BEL','country_name' => 'Belgica'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'CAN','country_name' => 'Canadá'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'MAR','country_name' => 'Marrocos'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'CRO','country_name' => 'Croácia'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'BRA','country_name' => 'Brasil'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'SBR','country_name' => 'Sérvia'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'SUI','country_name' => 'Suiça'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'CMR','country_name' => 'Camarões'],

        );
         \App\Models\Country::factory()->create(
            ['country_code' => 'POR','country_name' => 'Portugal'],

        );

        \App\Models\Country::factory()->create(
            ['country_code' => 'GHA','country_name' => 'Gana'],

        );

        \App\Models\Country::factory()->create(
            ['country_code' => 'URU','country_name' => 'Uruguai'],

        );

        \App\Models\Country::factory()->create(
            ['country_code' => 'KOR','country_name' => 'Korea'],

        );


    }
}
