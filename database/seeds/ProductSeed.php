<?php

use Illuminate\Database\Seeder;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'Test'],
            ['name' => 'Test1'],
        ];
        foreach ($items as $item) {
            \App\Models\Product::create($item);
        }
    }
}
