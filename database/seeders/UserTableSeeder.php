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
        $user->save();
    }
}
