<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeed extends Seeder
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
            \App\Models\Category::create($item);
        }
    }
}
