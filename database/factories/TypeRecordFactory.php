<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeRecord>
 */
class TypeRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static $customerRecord = [];

    public function definition(): array
    {
        $customer = Customer::doesntHave('TypeRecords')->orderby('id')->pluck('id')->toArray();
        if(empty(self::$customerRecord)){
            self::$customerRecord = $customer;
        }
        $customerRecord = array_shift(self::$customerRecord);
        return [
            'type' => strtoupper('Automatico'),
            'customer_id' => $customerRecord
        ];
    }
}
