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
        $dishes = config('restaurant_dishes');
        foreach ($dishes as $dish) {
            $new_dish = new Dish();
            $new_dish->name = $dish['name'];
            $new_dish->restaurant_id = rand(1, 4);
            $new_dish->description = $dish['description'];
            $new_dish->ingredients = $dish['ingredients'];
            $new_dish->size = $faker->word();
            $new_dish->price = $dish['price'];
            $new_dish->is_visible = true;
            $new_dish->image = $dish['image'];
            $new_dish->save();
        }
    }
}
