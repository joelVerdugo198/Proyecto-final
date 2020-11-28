<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Joel Verdugo";
        $user->email = "j@hotmail.com";
        $user->password = bcrypt("12345678");
        $user->role_id = 1;
        $user->save();

        $user = new User();
        $user->name = "Joel Verdugo";
        $user->email = "j@gmail.com";
        $user->password = bcrypt("12345678");
        $user->role_id = 2;
        $user->save();
    }
}
