<?php

use Illuminate\Database\Seeder;

class GroceriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create();
        for ($x = 0; $x <= 10; $x++) {
            $category = factory(App\Category::class)->create();
            factory(App\Item::class, 5)->create(['category_id' => $category->id]);        
        }
    }
}
