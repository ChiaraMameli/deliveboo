<?php

use Illuminate\Database\Seeder;
use App\Models\Dish;
use Faker\Generator as Faker;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {        
        for($i = 0; $i < 20; $i++){
            $new_dish = new Dish();
            $new_dish->name = $faker->word(30);
            $new_dish->restaurant_id = rand(1, 4);
            $new_dish->description = $faker->paragraph();
            $new_dish->ingredients = $faker->paragraph();
            $new_dish->size = $faker->word();
            $new_dish->price = $faker->numberBetween(0, 127);
            $new_dish->is_visible = $faker->boolean();
            $new_dish->image = $faker->imageUrl(300, 300, 'foods');
            $new_dish->save();
        }

    }
}
