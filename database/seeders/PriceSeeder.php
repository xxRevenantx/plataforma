<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prices = [
            '0',
            '100',
            '200',
            '400',
            '500',
        ];

        foreach ($prices as $price) {
            \App\Models\Price::create([
                'value' => $price,
            ]);
        }
    }
}
