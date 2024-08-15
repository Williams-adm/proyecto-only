<?php

namespace Database\Seeders;

use App\Models\Employee;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee = Employee::create([
            'name' => ucwords('elmo'),
            'paternal_surname' => ucwords('lujan'),
            'maternal_surname' => ucwords('carrion'),
            'date_of_brith' => '2000-05-18',
            'salary' => '1500.00',
            'payment_date' => 'Semanal'
        ]);

        $client = new Client();
        $imageUrl = 'https://picsum.photos/400/200';
        $imageName = 'employee/' . Str::slug($employee->name . '-' . $employee->paternal_surname . '-' . $employee->maternal_surname) . '.jpg';
        $response = $client->get($imageUrl);
        Storage::put('public/' . $imageName, $response->getBody());

        $employee->update(['photo_path' => $imageName]);

        Employee::factory(5)->create();
    }
}
