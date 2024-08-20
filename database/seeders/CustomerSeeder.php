<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Note;
use App\Models\Phone;
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
        $customer = Customer::all()->pluck('id')->toArray();

        foreach ($customer as $customerPhone){
            Phone::factory(1)->create([
                'phoneable_id' => $customerPhone,
                'phoneable_type' => Customer::class
            ]);
        }

        foreach($customer as $customerAddress){
            Address::factory(1)->create([
                'addressable_id' => $customerAddress,
                'addressable_type' => Customer::class
            ]);
        }

        foreach($customer as $customerNotes){
            Note::factory(1)->create([
                'noteable_id' => $customerNotes,
                'noteable_type' => Customer::class
            ]);
        }
    }
}
