<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'name' => ucwords('Francisco'),
            'paternal_surname' => ucwords('Sanchez'),
            'maternal_surname' => ucwords('Gaston'),
            'date_of_birth' => '2000-05-23'
        ]);
        
        Customer::create([
            'name' => ucwords('Pepito'),
            'paternal_surname' => ucwords('Orlando'),
            'maternal_surname' => ucwords('Sac'),
            'date_of_birth' => '1998-02-05'
        ]);

        Customer::factory(13)->create();
    }
}
