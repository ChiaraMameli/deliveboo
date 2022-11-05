<?php

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user_ids = User::pluck('id')->toArray();
        $restaurants = config('restaurants_name');

        foreach ($user_ids as $index => $user_id) {
            $restaurant = $restaurants[$index];
            $new_restaurant = new Restaurant();
            $new_restaurant->user_id = $user_id;
            $new_restaurant->name = $restaurant['name'];
            $new_restaurant->slug = Str::slug($restaurant['name'], '-');
            $new_restaurant->p_iva = $restaurant['p_iva'];
            $new_restaurant->address = $restaurant['address'];
            $new_restaurant->image = $restaurant['image'];
            $new_restaurant->save();
        }
    }
}
