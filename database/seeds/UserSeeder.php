<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = config('users');

        foreach($users as $user){
            $new_user = new User();
            $new_user->business_name = $user['business_name'];
            $new_user->email = $user['email'];
            $new_user->password = bcrypt($user['password']);
            $new_user->save();
        }
    }
}
