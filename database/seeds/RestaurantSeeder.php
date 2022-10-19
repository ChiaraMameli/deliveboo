<?php

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;

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

        foreach($user_ids as $user_id){
            $new_restaurant = new Restaurant();
            $new_restaurant->user_id = $user_id;
            $new_restaurant->restaurant_name = $faker->word(50);
            $new_restaurant->p_iva = $faker->word(13);
            $new_restaurant->address = $faker->address();
            $new_restaurant->restaurant_image = $faker->imageUrl(300, 300, 'foods');
            $new_restaurant->save();    
        }
    }
}
