<?php

use Illuminate\Database\Seeder;
use App\Models\Order;
use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 5; $i++){
            $new_order = new Order();
            $new_order->restaurant_id = 1;
            $new_order->amount = $faker->numberBetween(0, 3000);
            $new_order->customer_name = $faker->name();
            $new_order->customer_phone = $faker->phoneNumber();
            $new_order->customer_email = $faker->email();
            $new_order->customer_address = $faker->address();
            $new_order->save();
        }

    }
}