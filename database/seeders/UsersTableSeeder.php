<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(50)->create();

        $user = User::find(1);
        $user->name = 'Kuiperbelt';
        $user->email = 'colorabxy@gmail.com';
        $user->password = bcrypt('123456');
        $user->is_admin = true;
        $user->save();
    }
}
